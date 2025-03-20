<?php namespace ProcessWire;

/**
 * Process contact form
 * 
 * @param HookEvent $event ProcessWire hook event object
 */

function hookProcessForm(HookEvent $event) {

     if(!_isValidCSRF()) return _t('form_failedResponse');
    
     // set character limits to be sure, slightly larger than maxlength in the form input where form input maxlength has - 130, 130, 1400
    $limits = [
        'f_name' => 150,
        'f_email' => 150,
        'f_message' => 1500
    ];

    // set data
    $data = [
        'errors' => _t('errors'),
        'f_name' => input()->post('f_name','text,entities'), 
        'f_email' => input()->post('f_email','email'), 
        'f_message' => input()->post('f_message','textarea,entities'), 
        'f_pd' => input()->post('f_pd','checkbox'), // personal data
    ];
    $data = array_filter($data);

    // get IP address
    $ip = _getIP();

    // set form fields
    $name = $data['f_name'];
    $email = $data['f_email'];
    $message = $data['f_message'];

    // black list
    $blackList = _getLogEntries('black-list','text',['limit' => 5000]);

    if ($blackList) {
        $found = array_filter($blackList, function ($jsonString) use ($ip, $email) {
            $decoded = json_decode($jsonString, true);
            if (!$decoded) {
                return false; // Skips invalid logs
            }
            return $decoded && (
                in_array($ip, $decoded) || 
                in_array($email, $decoded)
            );
        });

        // We check if it already exists
        if ($found) {
            return Html::p(sprintf(_t('form_blackList'), $name), ['class' => 'alert -error']);
        }
    }

    // if empty form inputs
    if(count($data) < 5) {
        return _partial('_contactForm',$data);
    }

    // Block this user
    foreach ($limits as $key => $maxLength) {
        if (!empty($data[$key]) && is_string($data[$key]) && mb_strlen($data[$key]) > $maxLength) {
            _logError("The character limit on the contact form for this address has been exceeded: {$key}, Email: " . ($email ?? 'unknown'));
            return Html::p(_t('form_failedResponse'), ['class' => 'alert -error']); // You can add an error message or just quit.
        }
    }

     // https://processwire.com/api/ref/wire-mail/
     $m = wireMail(); // use wireMail() function
     $m->to(_site()->email)
     ->from($email, $name)
     ->subject('New Client')
     ->body(strip_tags($message))
     ->bodyHTML(<<<PHP
         <html><body><p>{$message}</p></body></html>
     PHP);
    
    if(!$m->send()) { 
        return Html::p(_t('form_errorMessage'),['class' => 'alert -error mw-xs']);
    }

    $contentBody = _renderMail('_welcome',[
        'siteName' => _site()->name,
        'siteUrl' => _site()->url,
        'logoURL' => _site()->logo->httpUrl,
        'welcome' => _t('form_autoresponderThank'),
        'content' => _t('form_autoresponderContent'),
    ]);

    // Send Welcome message for user
    $m->to($email)
    ->from(_site()->email, _site()->name)
    ->subject('Thanks for sbmit form')
    ->body(strip_tags($contentBody))
    ->bodyHTML($contentBody);
    
    if(!$m->send()) {
        _logError('Error sending welcome message to this user - ' . $email);
    }

    // save log
    if (_site()->saveContactLogs) {

        // Maximum requests per day, if exceeded the user will be added to the blacklist
        $maxRequest = _site()->contactPage->int ?: 30;

        // Create a unique log file for each day based on the current date (e.g., contact-attempts-2024-10-22.txt)
        $contactAttempts = 'contact-attempts-' . date('Y-m-d'); // A unique log file for each day

        // Download existing log entries
        $entries = _getLogEntries($contactAttempts,'text',['limit' => 5000]); // Downloads max. 5000 recent entries
        
        // check log
        if($entries) {
            
            // We filter entries by IP or E-mail
            $attempts = array_filter($entries, function ($entry) use ($ip, $email) {
                $logData = json_decode($entry, true); // We decode JSON into an array
        
                // We check whether the IP or Email matches the value in the record
                return (isset($logData['IP']) && $logData['IP'] === $ip) ||
                       (isset($logData['E-mail']) && $logData['E-mail'] === $email);
            });


            // set attempts
            $attempts = isset($attempts) ? $attempts : [];

            // If the limit is exceeded, we block
            if (count($attempts) >= $maxRequest) {

                _logError("Too many contact attempts from {$ip} - {$email} - {$name}");

                // save black list log
                _log('black-list',[
                    'IP' => $ip,
                    'E-mail' => $email
                ]);

                return Html::p(_t('form_attempts'), ['class' => 'alert -error']);
            }
        } 

        // Page url
        $pageID = input()->post('page_id','int');

        // reset variable
        $url = '';
        
        // set page url
        if ($pageID) {
            $page = pages()->get("id=$pageID,has_parent!=2,status!=hidden");
            if (isset($page->id)) {
                $url = sanitizer()->url($page->httpUrl());
            } 
        }

        // Collect user data
        $logData = [
            'IP'        => $ip,
            'UserAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown', // User's browser (User-Agent header)
            'Timestamp' => date("Y-m-d H:i:s"),                     // Date and time of the visit
            'Country'   => _getCountryFromIP($ip),     // User's country
            'Page' => $url,        // User's Page
            'Name' => $name, // User's name
            'E-mail' => $email,
            'Message' => $message, // User's message
        ];
        
        // save log 
        _log($contactAttempts, $logData);
    }

    // if success
    $l_name = _t('name');
    $l_email = _t('email');
    $l_message = _t('message');

    $thanksMessage = <<<HTML
        <p>{$l_name}: {$name}</p>
        <p>{$l_email}: {$email}</p>
        <p>{$l_message}: {$message}</p>
    HTML;

    $out = Html::p(_t('form_thanksMesage'),['class' => 'card -primary mw-xs']) . '<br>' . Html::section($thanksMessage, ['class' => 'card mw-xs' ]);
    $out .= _htmx([
        'hx-target' => ".formMessages",
        // 'modal' => true,
        'text' => _t('form_submitAgain') . ' ' .  _icon('envelope'),
        'class' => 'btn -icon',
        'title' => _t('form_submitAgain'),
        'requestVariable' => '?pageID=' . page()->id
    ])->getPartial('_contactForm');

    // return cotent
    return Html::div($out, ['class' => 'formMessages']);
 }
