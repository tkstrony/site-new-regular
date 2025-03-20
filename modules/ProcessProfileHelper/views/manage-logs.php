<?php namespace ProcessWire;

    $labelDeleteLogs = __('Delete logs');

    // delete logs
    if (isset($_POST['delete_logs'])) {
        if (isset($_POST['logs'])) {
            foreach ($_POST['logs'] as $logFile) {
                wire()->log->delete($logFile);
            }
            session()->message($labelDeleteLogs);
            session()->redirect('./');
        }
    }

    // search logs
    $search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
    $startDate = isset($_GET['start_date']) ? htmlspecialchars($_GET['start_date']) : '';
    $endDate = isset($_GET['end_date']) ? htmlspecialchars($_GET['end_date']) : '';
    $out = '';

    // Number of logs on the page
    $logsPerPage = 25;
    // Calculation of the current page
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($currentPage - 1) * $logsPerPage;

    // Downloading logs with pagination
    $allLogs = wire()->log->getLogs(); // Download all logs
    $filteredLogs = array_filter($allLogs, function($log) use ($search, $startDate, $endDate) {
        $matchesSearch = empty($search) || stripos($log['name'], $search) !== false;
        $matchesStartDate = empty($startDate) || $log['modified'] >= strtotime($startDate);

        // Sets endDate to the end of the day, if provided
        if (!empty($endDate)) {
            $endDateTime = strtotime($endDate . ' 23:59:59'); // Ustawia na koniec dnia
            $matchesEndDate = $log['modified'] <= $endDateTime;
        } else {
            $matchesEndDate = true; // If endDate is not set, matches
        }

        return $matchesSearch && $matchesStartDate && $matchesEndDate;
    });

    // Extracting logs for display
    $logsToDisplay = array_slice($filteredLogs, $offset, $logsPerPage);
    $logs = '';

    $adminUrl = pages()->get(config()->adminRootPageID)->name;

    // Viewing logs
    foreach ($logsToDisplay as $log) {
        $logUrl = "/$adminUrl/setup/logs/view/{$log['name']}/";
        $logs .= '<input type="checkbox" name="logs[]" value="' . $log['name'] . '" x-on:click="toggleSelection($event)">';
        $logs .= 'Name: ' . $log['name'] . '<br>';
        $logs .= 'File: ' . str_replace('\\', '/',$log['file']) . '<br>';
        $logs .= 'Size: ' . _formatFileSize($log['size'], 0) . '<br>';
        $logs .= 'Created date: ' . date('d-m-Y H:i:s', $log['modified']) . '<br>';
        $logs .= Html::a($logUrl, $labelViewLog,['class' => 'uk-button uk-button-primary uk-margin'])   . '<hr>';
    }

    $out .= <<<HTML
        <form class='uk-form-width-large' method="get" action="">
            <input class='uk-input' type="text" name="search" placeholder="{$labelSearchLogs}" value="{$search}"><br><br>
            <label class='uk-label'>{$labelStartDate}</label>
            <input class='uk-input' type="date" name="start_date" value="{$startDate}"><br>
            <label class='uk-label'>{$labelEndDate}</label>
            <input class='uk-input' type="date" name="end_date" value="{$endDate}"><br><br>
            <input class='uk-button' type="submit" value="{$labelSearch}">
        </form><br>
    HTML;

$out .= <<<HTML
	<form class='manageLogs' method="post" action="" x-data="{
			selected: [],
			lastChecked: null,
			toggleSelection(event) {
				if (event.shiftKey && this.lastChecked !== null) {
					const checkboxes = document.querySelectorAll(`input[name='logs[]']`);
					const current = event.target;
					const start = Array.from(checkboxes).indexOf(this.lastChecked);
					const end = Array.from(checkboxes).indexOf(current);
					const min = Math.min(start, end);
					const max = Math.max(start, end);
					for (let i = min; i <= max; i++) {
						checkboxes[i].checked = true;
						if (!this.selected.includes(checkboxes[i].value)) {
							this.selected.push(checkboxes[i].value);
						}
					}
				}
				this.lastChecked = event.target;
				if (!this.selected.includes(event.target.value)) {
					this.selected.push(event.target.value);
				} else {
					this.selected.splice(this.selected.indexOf(event.target.value), 1);
				}
			},
			clearSelection() {
				const checkboxes = document.querySelectorAll(`input[name='logs[]']`);
				checkboxes.forEach(checkbox => {
					checkbox.checked = false;
				});
				this.selected = [];
			}
		}" @keydown.escape="clearSelection()">

		{$logs}

		<button class='uk-button uk-button-danger uk-margin-bottom' type="submit" name="delete_logs" :disabled="selected.length === 0">
			{$labelDelLogs}
		</button>
	</form>
    <script src="$alpineURL" defer></script>
HTML;

    // Pagination
    $totalLogs = count($filteredLogs); // Get all filtered logs
    $totalPages = ceil($totalLogs / $logsPerPage);

    if($totalPages > 1) {
        for ($i = 1; $i <= $totalPages; $i++) {
            $out .= '<a href="?page=' . $i . '&search=' . urlencode($search) . '&start_date=' . $startDate . '&end_date=' . $endDate . '">' . $i . '</a> ';
        }
    }

    return Html::content($out);
