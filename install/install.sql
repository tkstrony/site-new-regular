# --- WireDatabaseBackup {"time":"2025-03-18 22:36:32","user":"","dbName":"db","description":"","tables":[],"excludeTables":["pages_drafts","pages_roles","permissions","roles","roles_permissions","users","users_roles","user","role","permission"],"excludeCreateTables":[],"excludeExportTables":["field_roles","field_permissions","field_email","field_pass","caches","session_login_throttle","page_path_history"]}

DROP TABLE IF EXISTS `caches`;
CREATE TABLE `caches` (
  `name` varchar(191) NOT NULL,
  `data` mediumtext NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`name`),
  KEY `expires` (`expires`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `field_admin_theme`;
CREATE TABLE `field_admin_theme` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(11) NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_admin_theme` (`pages_id`, `data`) VALUES('41', '187');

DROP TABLE IF EXISTS `field_adv_opt`;
CREATE TABLE `field_adv_opt` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(11) NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`,`sort`),
  KEY `data` (`data`,`pages_id`,`sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_adv_opt` (`pages_id`, `data`, `sort`) VALUES('1', '1034', '0');
INSERT INTO `field_adv_opt` (`pages_id`, `data`, `sort`) VALUES('1', '1070', '1');
INSERT INTO `field_adv_opt` (`pages_id`, `data`, `sort`) VALUES('1', '1138', '2');

DROP TABLE IF EXISTS `field_alerts`;
CREATE TABLE `field_alerts` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`,`sort`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_alerts` (`pages_id`, `data`, `sort`) VALUES('1072', '2', '0');
INSERT INTO `field_alerts` (`pages_id`, `data`, `sort`) VALUES('1074', '3', '0');
INSERT INTO `field_alerts` (`pages_id`, `data`, `sort`) VALUES('1080', '3', '0');
INSERT INTO `field_alerts` (`pages_id`, `data`, `sort`) VALUES('1089', '3', '0');
INSERT INTO `field_alerts` (`pages_id`, `data`, `sort`) VALUES('1092', '3', '0');
INSERT INTO `field_alerts` (`pages_id`, `data`, `sort`) VALUES('1110', '3', '0');

DROP TABLE IF EXISTS `field_block_images`;
CREATE TABLE `field_block_images` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` varchar(191) NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  `description` text NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `filedata` mediumtext DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `created_users_id` int(10) unsigned NOT NULL DEFAULT 0,
  `modified_users_id` int(10) unsigned NOT NULL DEFAULT 0,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `ratio` decimal(4,2) DEFAULT NULL,
  `tags` varchar(191) NOT NULL,
  PRIMARY KEY (`pages_id`,`sort`),
  KEY `data` (`data`),
  KEY `modified` (`modified`),
  KEY `created` (`created`),
  KEY `filesize` (`filesize`),
  KEY `width` (`width`),
  KEY `height` (`height`),
  KEY `ratio` (`ratio`),
  FULLTEXT KEY `description` (`description`),
  FULLTEXT KEY `filedata` (`filedata`),
  FULLTEXT KEY `tags` (`tags`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `field_body`;
CREATE TABLE `field_body` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` mediumtext NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data_exact` (`data`(191)),
  FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_body` (`pages_id`, `data`) VALUES('1027', '<blockquote>\n<p>Welcome to [Your Company Name]! We are a dynamic and innovative company specializing in [your industry or field]. Our mission is to [briefly describe your company\'s mission, e.g., \"provide cutting-edge technology solutions that make everyday life easier for our customers\"].</p>\n</blockquote>\n<h3>Our Story</h3>\n<p>Founded in [Year], [Your Company Name] began with a simple idea: [describe the initial idea or inspiration behind your company]. Since then, we have grown into a [size of your company, e.g., \"a leading provider of...\"] with a passionate team dedicated to [specific aspect of your service or product, e.g., \"delivering exceptional customer service and innovative products\"].</p>\n<h3>Our Values</h3>\n<p>At [Your Company Name], we believe in [core values, e.g., \"integrity, innovation, and community\"]. These values guide everything we do, from our relationships with customers to the products and services we offer. We are committed to [specific commitment, e.g., \"sustainability and ethical practices\"] in all aspects of our business.</p>\n<h3>What We Offer</h3>\n<p>Our team of experts is dedicated to [briefly describe what your company offers, e.g., \"developing high-quality software solutions tailored to meet the unique needs of our clients\"]. We take pride in our [unique selling points, e.g., \"attention to detail, cutting-edge technology, and personalized service\"].</p>\n<h3>Join Us</h3>\n<p>Whether you are a potential customer, a business partner, or someone interested in joining our team, we invite you to [call to action, e.g., \"explore our offerings and discover how we can work together to achieve your goals\"]. Feel free to [contact us, visit our office, etc.] to learn more about what we do and how we can help you.</p>\n<p>Thank you for visiting [Your Company Name]. We look forward to connecting with you!</p>');
INSERT INTO `field_body` (`pages_id`, `data`) VALUES('1030', '<h3>Personal Data Processing</h3>\n<p>At [Your Company Name], we prioritize the privacy of our customers and users. Below, we outline how we collect, process, and protect your personal data.</p>\n<h4>What Personal Data Do We Collect?</h4>\n<p>We collect personal data necessary to provide our services and improve the quality of our customer service. This data may include:</p>\n<ul>\n<li><strong>Contact Information:</strong> Name, email address, phone number.</li>\n<li><strong>Identification Information:</strong> National ID number, passport number (if required).</li>\n<li><strong>Transaction Data:</strong> Purchase history, payment history.</li>\n<li><strong>Technical Data:</strong> IP address, browser and device information, cookies.</li>\n</ul>\n<h3>Use of Google Analytics and Cookies</h3>\n<p>We use <strong>Google Analytics</strong> to track and analyze website traffic after obtaining user consent. This helps us optimize our services. A cookie consent banner will appear upon your first visit, giving you the option to manage how cookies are used on the site. You can adjust your preferences at any time.</p>\n<p>Please note, some cookies essential to the operation of the site may be stored without requiring consent.</p>\n<h4>For What Purpose Do We Process Your Data?</h4>\n<p>Personal data is processed for the following purposes:</p>\n<ul>\n<li><strong>Service Provision:</strong> Order fulfillment, customer support.</li>\n<li><strong>Personalization of Offerings:</strong> Customizing content and offers to your preferences.</li>\n<li><strong>Marketing:</strong> Sending information about new products, promotions, and special offers (with user consent).</li>\n<li><strong>Analysis and Statistics:</strong> Improving our services and better understanding user needs.</li>\n</ul>\n<h4>How Do We Protect Your Data?</h4>\n<p>We employ advanced technical and organizational measures to protect your personal data from unauthorized access, loss, or destruction. Our servers are secured according to the highest security standards.</p>\n<h4>Sharing of Personal Data</h4>\n<p>Your personal data may be shared with:</p>\n<ul>\n<li><strong>Partner Entities:</strong> IT service providers, courier companies, marketing partners who support us in providing our services.</li>\n<li><strong>Law Enforcement and Public Authorities:</strong> In cases prescribed by law.</li>\n</ul>\n<h4>Your Rights</h4>\n<p>You have the right to:</p>\n<ul>\n<li><strong>Access Your Personal Data:</strong> Request information about the data we process.</li>\n<li><strong>Correct Your Data:</strong> Update your data if it is outdated or incorrect.</li>\n<li><strong>Delete Your Data:</strong> Request the deletion of your data, provided it does not conflict with legal obligations.</li>\n<li><strong>Object to Data Processing:</strong> Object to the processing of your personal data for specific purposes.</li>\n</ul>\n<h4>Contact</h4>\n<p>If you have any questions about the processing of your personal data or wish to exercise your rights, please contact us:</p>\n<p>[Your Company Name]<br />[Company Address]<br />[Contact Email]<br />[Contact Phone Number]</p>\n<p>Thank you for your trust, and we invite you to enjoy our services!</p>');
INSERT INTO `field_body` (`pages_id`, `data`) VALUES('1032', '<p>Welcome to our Contact Page!</p>\n<p>We value your feedback and inquiries. Whether you have a question, a suggestion, or need assistance, please feel free to reach out to us using the form below. Our dedicated team is here to help and will get back to you as soon as possible.</p>\n<p><strong>Office Hours:</strong> Monday to Friday: 9:00 AM - 5:00 PM Saturday: 10:00 AM - 2:00 PM Sunday: Closed</p>\n<p>We look forward to hearing from you!</p>');
INSERT INTO `field_body` (`pages_id`, `data`) VALUES('1074', '<p>About Page notification</p>');
INSERT INTO `field_body` (`pages_id`, `data`) VALUES('1091', '<blockquote>\n<p>Choosing the right Content Management System (CMS) can significantly impact the success and efficiency of managing your website. ProcessWire CMS has gained popularity among developers and businesses for its unique blend of flexibility, power, and user-friendliness. In this article, we\'ll explore the key benefits of using ProcessWire CMS and how it can enhance your web development and content management experience.</p>\n</blockquote>\n<h3><strong>1. Unmatched Flexibility</strong></h3>\n<p>One of the most compelling benefits of ProcessWire is its unmatched flexibility. Unlike many other CMS platforms that impose rigid structures, ProcessWire provides a field-template system that allows developers to define custom content types and fields with ease. This flexibility means you can create a wide range of websites, from simple blogs to complex applications, without being restricted by the CMS\'s architecture. This customizable nature makes ProcessWire an excellent choice for projects that require unique data models or intricate design layouts.</p>\n<h3><strong>2. Powerful API</strong></h3>\n<p>ProcessWire\'s powerful API is a standout feature that empowers developers to create custom functionalities and integrations. The API is designed to be intuitive and consistent, making it easy to learn and use. Developers can access and manipulate content, users, and settings programmatically, enabling the creation of highly customized solutions. Whether you need to integrate third-party services, automate tasks, or build bespoke features, ProcessWire\'s API provides the tools necessary to get the job done.</p>\n<h3><strong>3. User-Friendly Interface</strong></h3>\n<p>Despite its powerful capabilities, ProcessWire maintains a user-friendly interface that is accessible to non-technical users. The admin panel is clean, modern, and intuitive, making content management straightforward. Users can easily add and manage pages, organize content hierarchically, and utilize a drag-and-drop interface for content arrangement. This ease of use ensures that editors and content creators can work efficiently without requiring extensive training.</p>\n<h3><strong>4. Robust Security</strong></h3>\n<p>Security is a top priority for any website, and ProcessWire excels in this regard. The CMS is built with security best practices in mind, offering strong user access controls and permission settings. It also includes features like anti-spam measures, form security, and protection against common web vulnerabilities. Additionally, the active development community and regular updates ensure that the platform remains secure against emerging threats.</p>\n<h3><strong>5. SEO-Friendly Features</strong></h3>\n<p>ProcessWire is designed to be SEO-friendly, helping you optimize your website for search engines. The CMS offers fine-grained control over URLs, metadata, and content structure, allowing you to implement SEO best practices easily. Furthermore, ProcessWire supports custom fields for adding specific SEO data, such as meta descriptions and keywords, directly within the content editor. This flexibility is invaluable for improving your site\'s visibility and ranking in search engine results. <br /><a	data-pwid=1108	href=\"/blog/boost-your-seo/\">See how to Improve Your SEO Ranking</a>.</p>\n<h3><strong>6. Multilingual Capabilities</strong></h3>\n<p>In today\'s global market, supporting multiple languages on your website is often essential. ProcessWire includes robust multilingual capabilities, allowing you to manage content in multiple languages seamlessly. The CMS supports multiple versions of pages and fields, providing a consistent and user-friendly experience for both administrators and end-users.</p>\n<h3><strong>7. Active Community and Support</strong></h3>\n<p>Another significant benefit of using ProcessWire is its active and supportive community. The community offers a wealth of resources, including documentation, tutorials, forums, and a module directory. Whether you\'re a beginner or an experienced developer, you can find assistance and guidance from fellow users and contributors. This strong community support enhances the overall experience of using ProcessWire and helps you get the most out of the platform.</p>\n<h3><strong>Conclusion</strong></h3>\n<p>ProcessWire CMS stands out as a versatile and robust platform that caters to the needs of developers, content creators, and businesses alike. Its flexibility, powerful API, user-friendly interface, and strong security features make it a compelling choice for any web development project. Whether you\'re building a simple blog or a complex application, ProcessWire provides the tools and capabilities needed to bring your vision to life. Embrace the benefits of ProcessWire and elevate your web development experience to new heights!</p>');
INSERT INTO `field_body` (`pages_id`, `data`) VALUES('1108', '<p><strong>Boost Your SEO with ProcessWire CMS!</strong></p>\n<p>In today\'s highly competitive online world, having a well-optimized website is crucial for SEO success. One of the most important factors is <strong>page load speed</strong>. Fast-loading websites not only improve user experience but also get rewarded by search engines like Google, which prioritize them in search rankings. With the internet becoming increasingly congested, the speed at which your scripts and pages load can make a significant difference in how well your site performs.</p>\n<p>Enter <strong>ProcessWire CMS</strong>&mdash;an ideal solution for those who take SEO seriously. Unlike other popular content management systems like WordPress, Joomla, or Drupal, ProcessWire is optimized for both <strong>speed</strong> and <strong>SEO-friendly URLs</strong>. Here\'s why:</p>\n<ol>\n<li>\n<p><strong>Blazing Fast Page Load Times</strong><br>ProcessWire&rsquo;s lightweight architecture and efficient caching ensure that websites load faster than many other CMS platforms. Fast loading times improve your site\'s SEO and help retain visitors, as slow-loading pages tend to drive users away.</p>\n</li>\n<li>\n<p><strong>SEO-Friendly URLs by Default</strong><br>ProcessWire automatically creates clean, human-readable URLs based on the page structure (like a tree), which reflects the content\'s hierarchy. This makes it easy for search engines to crawl and index your site effectively.</p>\n</li>\n<li>\n<p><strong>Customizable Meta Tags and Structured Data</strong><br>ProcessWire provides the flexibility to create your own custom fields for meta tags, titles, and structured data, giving you full control over your site\'s SEO. While it doesn&rsquo;t have built-in SEO options like other CMSs, with minimal effort, you can create everything needed to optimize your pages for maximum SEO impact. Implementing schema markup is straightforward, which improves your site&rsquo;s visibility in search engine results.</p>\n</li>\n<li>\n<p><strong>No Bloat&mdash;Just What You Need</strong><br>Unlike WordPress, which often relies on third-party plugins that can slow down your website, ProcessWire is lean and modular. You only install what you need, ensuring optimal performance without the extra overhead.</p>\n</li>\n<li>\n<p><strong>Scalable and Flexible</strong><br>Whether you\'re building a small blog or a large e-commerce site, ProcessWire scales to meet your needs without compromising performance. It&rsquo;s more adaptable than Joomla or Drupal, and often more efficient when handling complex SEO requirements.</p>\n</li>\n<li>\n<p><strong>Highly Secure</strong><br>ProcessWire&rsquo;s strong focus on security ensures that your website remains protected from vulnerabilities that could harm its SEO reputation. A secure site is favored by search engines and trusted by users.</p>\n</li>\n</ol>\n<p>In conclusion, ProcessWire offers the perfect balance of flexibility, speed, and SEO optimization, making it a superior choice over other CMS platforms like WordPress, Drupal, and Joomla. If you&rsquo;re serious about SEO and site performance, <strong>ProcessWire CMS</strong> is the smart choice to help your website stand out in search engine rankings.</p>');
INSERT INTO `field_body` (`pages_id`, `data`) VALUES('1124', '<p>https://youtu.be/mukK2kCHecQ?si=q8g0iUp2oFaY3HjK</p>');
INSERT INTO `field_body` (`pages_id`, `data`) VALUES('1128', '<p><strong>ProcessWire Weekly</strong> is a community-driven weekly newsletter and website that keeps you up to date with the latest news, updates, and insights about the ProcessWire CMS. The newsletter is curated by <strong><a href=\"https://processwire.com/talk/profile/175-teppo/\" target=\"_blank\" rel=\"noopener noreferrer\">Teppo Koivula</a></strong>, a long-time ProcessWire community member and developer.</p>\n<p>Each issue typically includes:</p>\n<ul>\n<li><strong>Weekly updates from Ryan Cramer</strong> – insights and announcements from the creator of ProcessWire.</li>\n<li><strong>New and updated modules</strong> – a roundup of community-created and official module releases.</li>\n<li><strong>Featured content</strong> – interesting forum discussions, blog posts, and tutorials.</li>\n<li><strong>Tips &amp; tricks</strong> – practical advice to enhance your ProcessWire development workflow.</li>\n</ul>\n<p>The newsletter is a great way to stay connected with the <strong>ProcessWire community</strong>, discover useful resources, and keep track of ongoing developments. Whether you\'re a seasoned developer or just getting started, <strong>ProcessWire Weekly</strong> is your go-to source for everything related to this powerful and flexible CMS!</p>');
INSERT INTO `field_body` (`pages_id`, `data`) VALUES('1142', '<blockquote>\n<p>The ultimate “swiss army knife” debugging and development tool for the <a href=\"https://processwire.com/\" target=\"_blank\" rel=\"noopener noreferrer\">ProcessWire</a> CMF/CMS</p>\n</blockquote>');

DROP TABLE IF EXISTS `field_categories`;
CREATE TABLE `field_categories` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(11) NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`,`sort`),
  KEY `data` (`data`,`pages_id`,`sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_categories` (`pages_id`, `data`, `sort`) VALUES('1091', '1097', '0');
INSERT INTO `field_categories` (`pages_id`, `data`, `sort`) VALUES('1091', '1100', '1');
INSERT INTO `field_categories` (`pages_id`, `data`, `sort`) VALUES('1108', '1111', '0');

DROP TABLE IF EXISTS `field_cbox`;
CREATE TABLE `field_cbox` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` tinyint(4) NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_cbox` (`pages_id`, `data`) VALUES('1124', '1');

DROP TABLE IF EXISTS `field_cbox_1`;
CREATE TABLE `field_cbox_1` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` tinyint(4) NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_cbox_1` (`pages_id`, `data`) VALUES('1056', '1');
INSERT INTO `field_cbox_1` (`pages_id`, `data`) VALUES('1058', '1');
INSERT INTO `field_cbox_1` (`pages_id`, `data`) VALUES('1124', '1');
INSERT INTO `field_cbox_1` (`pages_id`, `data`) VALUES('1128', '1');
INSERT INTO `field_cbox_1` (`pages_id`, `data`) VALUES('1142', '1');

DROP TABLE IF EXISTS `field_cbox_2`;
CREATE TABLE `field_cbox_2` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` tinyint(4) NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_cbox_2` (`pages_id`, `data`) VALUES('1128', '1');
INSERT INTO `field_cbox_2` (`pages_id`, `data`) VALUES('1142', '1');

DROP TABLE IF EXISTS `field_comments`;
CREATE TABLE `field_comments` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` text NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) NOT NULL DEFAULT 0,
  `cite` varchar(128) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL DEFAULT '',
  `created` int(10) unsigned NOT NULL,
  `created_users_id` int(10) unsigned NOT NULL,
  `ip` varchar(45) NOT NULL DEFAULT '',
  `user_agent` varchar(191) NOT NULL DEFAULT '',
  `website` varchar(191) NOT NULL DEFAULT '',
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `flags` int(10) unsigned NOT NULL DEFAULT 0,
  `code` varchar(128) DEFAULT NULL,
  `subcode` varchar(40) DEFAULT NULL,
  `upvotes` int(10) unsigned NOT NULL DEFAULT 0,
  `downvotes` int(10) unsigned NOT NULL DEFAULT 0,
  `stars` tinyint(3) unsigned DEFAULT NULL,
  `meta` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_id_sort` (`pages_id`,`sort`),
  KEY `status` (`status`,`email`),
  KEY `pages_id` (`pages_id`,`status`,`created`),
  KEY `created` (`created`,`status`),
  KEY `code` (`code`),
  KEY `subcode` (`subcode`),
  FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `field_comments_votes`;
CREATE TABLE `field_comments_votes` (
  `comment_id` int(10) unsigned NOT NULL,
  `vote` tinyint(4) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(45) NOT NULL DEFAULT '',
  `user_id` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`comment_id`,`ip`,`vote`),
  KEY `created` (`created`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `field_contact_info`;
CREATE TABLE `field_contact_info` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_contact_info` (`pages_id`, `data`) VALUES('1032', '1051');

DROP TABLE IF EXISTS `field_content_blocks`;
CREATE TABLE `field_content_blocks` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(11) NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`,`sort`),
  KEY `data` (`data`,`pages_id`,`sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_content_blocks` (`pages_id`, `data`, `sort`) VALUES('1', '1124', '0');
INSERT INTO `field_content_blocks` (`pages_id`, `data`, `sort`) VALUES('1', '1128', '1');
INSERT INTO `field_content_blocks` (`pages_id`, `data`, `sort`) VALUES('1', '1142', '2');
INSERT INTO `field_content_blocks` (`pages_id`, `data`, `sort`) VALUES('1', '1141', '3');

DROP TABLE IF EXISTS `field_date`;
CREATE TABLE `field_date` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_date` (`pages_id`, `data`) VALUES('1091', '2025-02-26 23:30:00');

DROP TABLE IF EXISTS `field_email`;
CREATE TABLE `field_email` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` varchar(191) NOT NULL DEFAULT '',
  PRIMARY KEY (`pages_id`),
  KEY `data_exact` (`data`),
  FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `field_fieldset_p`;
CREATE TABLE `field_fieldset_p` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(11) NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `field_fieldset_p_end`;
CREATE TABLE `field_fieldset_p_end` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(11) NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `field_guest_notification`;
CREATE TABLE `field_guest_notification` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_guest_notification` (`pages_id`, `data`) VALUES('1', '1072');
INSERT INTO `field_guest_notification` (`pages_id`, `data`) VALUES('1027', '1074');
INSERT INTO `field_guest_notification` (`pages_id`, `data`) VALUES('1032', '1080');
INSERT INTO `field_guest_notification` (`pages_id`, `data`) VALUES('1030', '1086');
INSERT INTO `field_guest_notification` (`pages_id`, `data`) VALUES('1088', '1089');
INSERT INTO `field_guest_notification` (`pages_id`, `data`) VALUES('1091', '1092');
INSERT INTO `field_guest_notification` (`pages_id`, `data`) VALUES('1094', '1095');
INSERT INTO `field_guest_notification` (`pages_id`, `data`) VALUES('1097', '1099');
INSERT INTO `field_guest_notification` (`pages_id`, `data`) VALUES('1100', '1102');
INSERT INTO `field_guest_notification` (`pages_id`, `data`) VALUES('1105', '1107');
INSERT INTO `field_guest_notification` (`pages_id`, `data`) VALUES('1108', '1110');
INSERT INTO `field_guest_notification` (`pages_id`, `data`) VALUES('1111', '1113');

DROP TABLE IF EXISTS `field_image`;
CREATE TABLE `field_image` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` varchar(191) NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  `description` text NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `filedata` mediumtext DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `created_users_id` int(10) unsigned NOT NULL DEFAULT 0,
  `modified_users_id` int(10) unsigned NOT NULL DEFAULT 0,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `ratio` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`pages_id`,`sort`),
  KEY `data` (`data`),
  KEY `modified` (`modified`),
  KEY `created` (`created`),
  KEY `filesize` (`filesize`),
  KEY `width` (`width`),
  KEY `height` (`height`),
  KEY `ratio` (`ratio`),
  FULLTEXT KEY `description` (`description`),
  FULLTEXT KEY `filedata` (`filedata`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_image` (`pages_id`, `data`, `sort`, `description`, `modified`, `created`, `filedata`, `filesize`, `created_users_id`, `modified_users_id`, `width`, `height`, `ratio`) VALUES('1128', 'weekly-pw.png', '0', '', '2025-03-10 21:38:32', '2025-03-10 21:38:32', '', '10574', '41', '41', '553', '254', '2.18');
INSERT INTO `field_image` (`pages_id`, `data`, `sort`, `description`, `modified`, `created`, `filedata`, `filesize`, `created_users_id`, `modified_users_id`, `width`, `height`, `ratio`) VALUES('1142', 'tracy.svg', '0', '', '2025-03-16 14:36:24', '2025-03-16 14:36:24', '', '2867', '41', '41', '150', '156', '0.96');

DROP TABLE IF EXISTS `field_images`;
CREATE TABLE `field_images` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` varchar(191) NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  `description` text NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `filedata` mediumtext DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `created_users_id` int(10) unsigned NOT NULL DEFAULT 0,
  `modified_users_id` int(10) unsigned NOT NULL DEFAULT 0,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `ratio` decimal(4,2) DEFAULT NULL,
  `tags` varchar(191) NOT NULL,
  PRIMARY KEY (`pages_id`,`sort`),
  KEY `data` (`data`),
  KEY `modified` (`modified`),
  KEY `created` (`created`),
  KEY `filesize` (`filesize`),
  KEY `width` (`width`),
  KEY `height` (`height`),
  KEY `ratio` (`ratio`),
  FULLTEXT KEY `description` (`description`),
  FULLTEXT KEY `filedata` (`filedata`),
  FULLTEXT KEY `tags` (`tags`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_images` (`pages_id`, `data`, `sort`, `description`, `modified`, `created`, `filedata`, `filesize`, `created_users_id`, `modified_users_id`, `width`, `height`, `ratio`, `tags`) VALUES('1023', 'coffee.svg', '0', '', '2025-03-11 08:14:55', '2025-03-11 08:14:55', '', '644', '41', '41', '32', '32', '1.00', 'logo favicon');
INSERT INTO `field_images` (`pages_id`, `data`, `sort`, `description`, `modified`, `created`, `filedata`, `filesize`, `created_users_id`, `modified_users_id`, `width`, `height`, `ratio`, `tags`) VALUES('1073', 'baumrock-com.png', '0', '', '2025-02-25 20:29:14', '2025-02-25 20:29:14', '', '11226', '41', '41', '460', '460', '1.00', 'youtube_processWireRocks');
INSERT INTO `field_images` (`pages_id`, `data`, `sort`, `description`, `modified`, `created`, `filedata`, `filesize`, `created_users_id`, `modified_users_id`, `width`, `height`, `ratio`, `tags`) VALUES('1073', 'processwire.png', '1', '', '2025-02-26 15:01:43', '2025-02-25 20:30:01', '', '6013', '41', '41', '512', '512', '1.00', 'twitter_processWire youtube_ryanCramer');
INSERT INTO `field_images` (`pages_id`, `data`, `sort`, `description`, `modified`, `created`, `filedata`, `filesize`, `created_users_id`, `modified_users_id`, `width`, `height`, `ratio`, `tags`) VALUES('1091', 'processwire.png', '0', '', '2025-03-07 21:10:42', '2025-03-07 21:10:42', '', '6013', '41', '41', '512', '512', '1.00', '');
INSERT INTO `field_images` (`pages_id`, `data`, `sort`, `description`, `modified`, `created`, `filedata`, `filesize`, `created_users_id`, `modified_users_id`, `width`, `height`, `ratio`, `tags`) VALUES('1108', 'stockcake-digital_analytics_dashboard.jpg', '0', '', '2025-03-07 21:17:38', '2025-03-07 21:17:38', '{\"uploadName\":\"StockCake-Digital Analytics Dashboard.jpg\"}', '73011', '41', '41', '1024', '1024', '1.00', '');

DROP TABLE IF EXISTS `field_int`;
CREATE TABLE `field_int` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(11) NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_int` (`pages_id`, `data`) VALUES('1032', '20');

DROP TABLE IF EXISTS `field_lang`;
CREATE TABLE `field_lang` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`,`sort`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `field_likes`;
CREATE TABLE `field_likes` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(11) NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_likes` (`pages_id`, `data`) VALUES('1091', '4');
INSERT INTO `field_likes` (`pages_id`, `data`) VALUES('1108', '45');

DROP TABLE IF EXISTS `field_link`;
CREATE TABLE `field_link` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_link` (`pages_id`, `data`) VALUES('1055', '1056');
INSERT INTO `field_link` (`pages_id`, `data`) VALUES('1057', '1058');
INSERT INTO `field_link` (`pages_id`, `data`) VALUES('1139', '1140');

DROP TABLE IF EXISTS `field_metadescription`;
CREATE TABLE `field_metadescription` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` mediumtext NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data_exact` (`data`(191)),
  FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_metadescription` (`pages_id`, `data`) VALUES('1025', 'Dive into the ProcessWire CMS and watch your world transform!');
INSERT INTO `field_metadescription` (`pages_id`, `data`) VALUES('1028', 'Explore our dedicated team\'s mission to provide you with high-quality products and services that exceed your expectations.');
INSERT INTO `field_metadescription` (`pages_id`, `data`) VALUES('1033', 'Whether you have questions, feedback, or suggestions, contact us via phone, email, or our online form – we\'d love to hear from you.');
INSERT INTO `field_metadescription` (`pages_id`, `data`) VALUES('1093', 'Learn about its flexibility, power, and rich feature set that make it an excellent choice for managing your website\'s content.');
INSERT INTO `field_metadescription` (`pages_id`, `data`) VALUES('1109', 'Explore essential tips and best practices for elevating your website\'s search engine ranking. From keyword optimization to building high-quality backlinks');

DROP TABLE IF EXISTS `field_opt`;
CREATE TABLE `field_opt` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_opt` (`pages_id`, `data`) VALUES('1', '1023');

DROP TABLE IF EXISTS `field_pass`;
CREATE TABLE `field_pass` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` char(40) NOT NULL,
  `salt` char(32) NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_general_ci;

DROP TABLE IF EXISTS `field_permissions`;
CREATE TABLE `field_permissions` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(11) NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`,`sort`),
  KEY `data` (`data`,`pages_id`,`sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `field_process`;
CREATE TABLE `field_process` (
  `pages_id` int(11) NOT NULL DEFAULT 0,
  `data` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_process` (`pages_id`, `data`) VALUES('10', '7');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('23', '10');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('3', '12');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('8', '12');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('9', '14');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('6', '17');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('11', '47');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('16', '48');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('21', '50');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('29', '66');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('30', '68');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('22', '76');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('28', '76');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('2', '87');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('300', '104');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('301', '109');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('302', '121');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('303', '129');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('31', '136');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('304', '138');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('1007', '150');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('1010', '175');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('1012', '200');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('1016', '5575');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('1018', '5585');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('1021', '5595');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('1065', '5616');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('1067', '5617');
INSERT INTO `field_process` (`pages_id`, `data`) VALUES('1068', '5618');

DROP TABLE IF EXISTS `field_roles`;
CREATE TABLE `field_roles` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(11) NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`,`sort`),
  KEY `data` (`data`,`pages_id`,`sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `field_seo`;
CREATE TABLE `field_seo` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_seo` (`pages_id`, `data`) VALUES('1', '1025');
INSERT INTO `field_seo` (`pages_id`, `data`) VALUES('27', '1026');
INSERT INTO `field_seo` (`pages_id`, `data`) VALUES('1027', '1028');
INSERT INTO `field_seo` (`pages_id`, `data`) VALUES('1030', '1031');
INSERT INTO `field_seo` (`pages_id`, `data`) VALUES('1032', '1033');
INSERT INTO `field_seo` (`pages_id`, `data`) VALUES('1088', '1090');
INSERT INTO `field_seo` (`pages_id`, `data`) VALUES('1091', '1093');
INSERT INTO `field_seo` (`pages_id`, `data`) VALUES('1094', '1096');
INSERT INTO `field_seo` (`pages_id`, `data`) VALUES('1097', '1098');
INSERT INTO `field_seo` (`pages_id`, `data`) VALUES('1100', '1101');
INSERT INTO `field_seo` (`pages_id`, `data`) VALUES('1105', '1106');
INSERT INTO `field_seo` (`pages_id`, `data`) VALUES('1108', '1109');
INSERT INTO `field_seo` (`pages_id`, `data`) VALUES('1111', '1112');

DROP TABLE IF EXISTS `field_site_pages`;
CREATE TABLE `field_site_pages` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(11) NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`,`sort`),
  KEY `data` (`data`,`pages_id`,`sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_site_pages` (`pages_id`, `data`, `sort`) VALUES('1', '1032', '0');
INSERT INTO `field_site_pages` (`pages_id`, `data`, `sort`) VALUES('1', '1030', '1');

DROP TABLE IF EXISTS `field_social_profiles`;
CREATE TABLE `field_social_profiles` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(11) NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`,`sort`),
  KEY `data` (`data`,`pages_id`,`sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_social_profiles` (`pages_id`, `data`, `sort`) VALUES('1', '1042', '0');
INSERT INTO `field_social_profiles` (`pages_id`, `data`, `sort`) VALUES('1', '1043', '1');
INSERT INTO `field_social_profiles` (`pages_id`, `data`, `sort`) VALUES('1', '1044', '2');
INSERT INTO `field_social_profiles` (`pages_id`, `data`, `sort`) VALUES('1', '1045', '3');
INSERT INTO `field_social_profiles` (`pages_id`, `data`, `sort`) VALUES('1', '1046', '4');
INSERT INTO `field_social_profiles` (`pages_id`, `data`, `sort`) VALUES('1', '1047', '5');
INSERT INTO `field_social_profiles` (`pages_id`, `data`, `sort`) VALUES('1', '1048', '6');
INSERT INTO `field_social_profiles` (`pages_id`, `data`, `sort`) VALUES('1', '1049', '7');

DROP TABLE IF EXISTS `field_theme`;
CREATE TABLE `field_theme` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`,`sort`),
  KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `field_title`;
CREATE TABLE `field_title` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data_exact` (`data`(191)),
  FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1', 'Home');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('2', 'Admin');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('3', 'Pages');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('6', 'Add Page');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('7', 'Trash');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('8', 'Tree');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('9', 'Save Sort');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('10', 'Edit');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('11', 'Templates');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('16', 'Fields');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('21', 'Modules');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('22', 'Setup');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('23', 'Login');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('27', '404 Not Found');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('28', 'Access');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('29', 'Users');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('30', 'Roles');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('31', 'Permissions');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('32', 'Edit pages');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('34', 'Delete pages');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('35', 'Move pages (change parent)');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('36', 'View pages');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('50', 'Sort child pages');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('51', 'Change templates on pages');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('52', 'Administer users');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('53', 'User can update profile/password');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('54', 'Lock or unlock a page');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('300', 'Search');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('301', 'Empty Trash');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('302', 'Insert Link');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('303', 'Insert Image');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('304', 'Profile');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1006', 'Use Page Lister');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1007', 'Find');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1010', 'Recent');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1011', 'Can see recently edited pages');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1012', 'Logs');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1013', 'Can view system logs');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1014', 'Can manage system logs');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1015', 'Repeaters');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1016', 'Comments');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1017', 'Use the comments manager');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1018', 'Clone');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1019', 'Clone a page');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1020', 'Clone a tree of pages');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1021', 'Export/Import');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1022', 'opt');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1024', 'seo');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1027', 'About');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1029', 'Advanced options');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1030', 'Personal data');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1032', 'Contact');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1034', 'Save guest visit logs');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1035', 'Enable CSP');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1036', 'Google Analytics Tracking Code');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1037', 'Google webmaster verification code');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1038', 'Copyright information');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1039', 'Disable Comments');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1040', 'Disable Contact Form');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1041', 'Social Profiles');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1042', 'X.com');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1043', 'Facebook');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1044', 'YouTube');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1045', 'TikTok');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1046', 'Instagram');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1047', 'LinkedIn');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1048', 'Snapchat');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1049', 'Github');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1050', 'contact_info');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1052', 'useful_links');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1053', 'link');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1054', 'home');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1065', 'Profile Helper');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1066', 'Run the profilehelper module');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1067', 'Helper Backup');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1068', 'Helper Oembed');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1070', 'Save contact as log');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1071', 'guest_notification');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1073', 'Oembed profiles images');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1077', 'Content blocks');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1088', 'Blog');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1091', 'The Benefits of Using ProcessWire CMS');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1094', 'Categories');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1097', 'CMS');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1100', 'ProcessWire');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1105', 'Sitemap');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1108', 'Boost Your SEO!');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1111', 'SEO');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1124', 'ProcessWire repeaters copy-paste');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1128', 'ProcessWire Weekly');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1138', 'Enable htmx boost');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1141', 'Building websites with a CMS has never been more simple and fun');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1142', 'Tracy Debugger for ProcessWire');
INSERT INTO `field_title` (`pages_id`, `data`) VALUES('1143', 'User zone');

DROP TABLE IF EXISTS `field_titletag`;
CREATE TABLE `field_titletag` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data_exact` (`data`(191)),
  FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_titletag` (`pages_id`, `data`) VALUES('1025', 'Your Little Buddy for a ProcessWire Kick-Start');
INSERT INTO `field_titletag` (`pages_id`, `data`) VALUES('1028', 'Get To Know Us Better!');
INSERT INTO `field_titletag` (`pages_id`, `data`) VALUES('1033', 'Our friendly and knowledgeable team is always here to help.');
INSERT INTO `field_titletag` (`pages_id`, `data`) VALUES('1093', 'Discover The Advantages Of ProcessWire CMS!');
INSERT INTO `field_titletag` (`pages_id`, `data`) VALUES('1109', 'How to Improve Your SEO Ranking');

DROP TABLE IF EXISTS `field_txt_1`;
CREATE TABLE `field_txt_1` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data_exact` (`data`(191)),
  FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_txt_1` (`pages_id`, `data`) VALUES('1023', 'newRegular');
INSERT INTO `field_txt_1` (`pages_id`, `data`) VALUES('1036', 'SET GA CODE');
INSERT INTO `field_txt_1` (`pages_id`, `data`) VALUES('1037', 'SET GV Code');
INSERT INTO `field_txt_1` (`pages_id`, `data`) VALUES('1038', 'My wonderful site');
INSERT INTO `field_txt_1` (`pages_id`, `data`) VALUES('1042', 'https://x.com/');
INSERT INTO `field_txt_1` (`pages_id`, `data`) VALUES('1043', 'https://www.facebook.com/');
INSERT INTO `field_txt_1` (`pages_id`, `data`) VALUES('1044', 'https://www.youtube.com/');
INSERT INTO `field_txt_1` (`pages_id`, `data`) VALUES('1045', 'https://www.tiktok.com/');
INSERT INTO `field_txt_1` (`pages_id`, `data`) VALUES('1046', 'https://www.instagram.com/');
INSERT INTO `field_txt_1` (`pages_id`, `data`) VALUES('1047', 'https://www.linkedin.com/');
INSERT INTO `field_txt_1` (`pages_id`, `data`) VALUES('1048', 'https://www.snapchat.com/');
INSERT INTO `field_txt_1` (`pages_id`, `data`) VALUES('1049', 'https://github.com/');
INSERT INTO `field_txt_1` (`pages_id`, `data`) VALUES('1051', '+1 (123) 456-7890');
INSERT INTO `field_txt_1` (`pages_id`, `data`) VALUES('1056', 'ProcessWire.com');
INSERT INTO `field_txt_1` (`pages_id`, `data`) VALUES('1058', 'Weekly.pw');

DROP TABLE IF EXISTS `field_txt_2`;
CREATE TABLE `field_txt_2` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data_exact` (`data`(191)),
  FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_txt_2` (`pages_id`, `data`) VALUES('1051', '1234 Main Street, Your City, Your Country');

DROP TABLE IF EXISTS `field_txtarea_1`;
CREATE TABLE `field_txtarea_1` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` mediumtext NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data_exact` (`data`(191)),
  FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_txtarea_1` (`pages_id`, `data`) VALUES('1023', 'Site profile');
INSERT INTO `field_txtarea_1` (`pages_id`, `data`) VALUES('1051', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14092.755172908432!2d86.91467534652304!3d27.98811976636015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e854a215bd9ebd%3A0x576dcf806abbab2!2sMount%20Everest!5e0!3m2!1spl!2spl!4v1719953996286!5m2!1spl!2spl\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>');
INSERT INTO `field_txtarea_1` (`pages_id`, `data`) VALUES('1141', '// Render your site’s primary navigation\necho $pages->get(\'/\')->children->each(\'<li><a href={url}>{title}</a>\');\n\n// Find buildings: built before 1950, 10+ floors, sort by height\n$pages->find(\'template=building, year<1950, floors>=10, sort=height\');\n\n// Output field “headline” when present or “title” if not\necho \'<h1>\' . $page->get(\'headline|title\') . \'</h1>\';\n\n// Get “email” field from /contact/ page and use it in link\n<a href=\'mailto:<?= $pages->get(\'/contact/\')->email ?>\'>Email</a>\n\n// Output first “images” field item on page at 90px width\n<img src=\'<?= $page->images->first->width(90)->url ?>\'>\n\n// Set “headline” field value on page and save to database\n$page->setAndSave(\'headline\', \'Hello world\');');

DROP TABLE IF EXISTS `field_url_1`;
CREATE TABLE `field_url_1` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data_exact` (`data`(191)),
  FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_url_1` (`pages_id`, `data`) VALUES('1056', 'https://processwire.com/');
INSERT INTO `field_url_1` (`pages_id`, `data`) VALUES('1058', 'https://weekly.pw/');
INSERT INTO `field_url_1` (`pages_id`, `data`) VALUES('1128', 'https://weekly.pw/');
INSERT INTO `field_url_1` (`pages_id`, `data`) VALUES('1142', 'https://adrianbj.github.io/TracyDebugger/#/?id=tracy-debugger-for-processwire');

DROP TABLE IF EXISTS `field_useful_links`;
CREATE TABLE `field_useful_links` (
  `pages_id` int(10) unsigned NOT NULL,
  `data` text NOT NULL,
  `count` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `data_exact` (`data`(1)),
  KEY `count` (`count`,`pages_id`),
  KEY `parent_id` (`parent_id`,`pages_id`),
  FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `field_useful_links` (`pages_id`, `data`, `count`, `parent_id`) VALUES('1', '1055,1057', '2', '1054');

DROP TABLE IF EXISTS `fieldgroups`;
CREATE TABLE `fieldgroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `fieldgroups` (`id`, `name`) VALUES('2', 'admin');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('83', 'basic-page');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('114', 'blog');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('116', 'blog-post');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('113', 'categories');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('115', 'category');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('101', 'contact');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('110', 'field-block_images');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('1', 'home');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('100', 'http404');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('5', 'permission');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('102', 'personal-data');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('104', 'repeater_contact_info');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('107', 'repeater_guest_notification');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('106', 'repeater_link');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('97', 'repeater_opt');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('98', 'repeater_seo');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('105', 'repeater_useful_links');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('4', 'role');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('117', 'sitemap');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('3', 'user');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('120', 'user-todo');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('119', 'user-zone');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('99', '_adv-opt');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('111', '_blockContent');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('109', '_blockImages');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('112', '_blockPhiki');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('108', '_opt-img');
INSERT INTO `fieldgroups` (`id`, `name`) VALUES('103', '_opt-txt');

DROP TABLE IF EXISTS `fieldgroups_fields`;
CREATE TABLE `fieldgroups_fields` (
  `fieldgroups_id` int(10) unsigned NOT NULL DEFAULT 0,
  `fields_id` int(10) unsigned NOT NULL DEFAULT 0,
  `sort` int(11) unsigned NOT NULL DEFAULT 0,
  `data` text DEFAULT NULL,
  PRIMARY KEY (`fieldgroups_id`,`fields_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('1', '1', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('1', '98', '4', '{\"collapsed\":\"5\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('1', '102', '10', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('1', '104', '1', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('1', '105', '11', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('1', '107', '6', '{\"collapsed\":\"20\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('1', '108', '5', '{\"collapsed\":\"1\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('1', '111', '7', '{\"collapsed\":\"1\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('1', '115', '8', '{\"collapsed\":\"1\",\"label\":\"Site internal links\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('1', '116', '2', '{\"collapsed\":\"20\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('1', '119', '12', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('1', '131', '3', '{\"collapsed\":\"1\",\"label\":\"Site Options\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('1', '132', '9', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('2', '1', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('2', '2', '1', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('3', '3', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('3', '4', '2', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('3', '92', '1', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('3', '97', '3', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('4', '5', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('5', '1', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('83', '1', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('83', '102', '3', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('83', '104', '1', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('83', '105', '4', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('83', '116', '2', '{\"description\":\"This notification will overwrite the main one which is on the home page\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('83', '119', '5', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('97', '100', '0', '{\"label\":\"Site name\",\"maxlength\":2048}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('97', '101', '1', '{\"label\":\"Site Description\",\"rows\":1}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('97', '102', '2', '{\"description\":\"Set the logo and favicon by adding the appropriate tag to the image field - logo, favicon\",\"label\":\"Logo \\/ favicon\",\"tagsList\":\"logo favicon\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('98', '99', '0', '{\"description\":\"The optimal length for a title tag is approximately 50-60 characters. It\'s important to include key words related to the page\'s content to attract user attention and improve search engine rankings.\",\"notes\":\"A title tag, also known as a meta title, is an HTML element used in the header of a web page. It is a short phrase or sentence that describes the content of a particular page. The title tag appears on the browser\'s title bar and in Google search results as the header of the link to your page.\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('98', '103', '1', '{\"description\":\"The optimal length for a meta description is around 150-160 characters. Although Google may display longer meta descriptions, it is recommended to stick to this length to ensure readability and precise information delivery. It\'s also a good practice to include key words but avoid overusing them.\",\"notes\":\"A meta description is a brief snippet that describes the content of a web page. It is displayed beneath the link in Google search results and is intended to entice users to click on the page.\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('99', '1', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('100', '1', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('100', '102', '3', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('100', '104', '1', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('100', '105', '4', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('100', '116', '2', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('101', '1', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('101', '102', '5', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('101', '104', '1', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('101', '105', '6', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('101', '109', '4', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('101', '116', '2', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('101', '119', '7', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('101', '129', '3', '{\"description\":\"The maximum number of form requests per user\",\"label\":\"Limit requests\",\"notes\":\"Maximum daily number of messages sent via the contact form, exceeding which the user will be blocked (he will be added to the blacklist log)\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('102', '1', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('102', '102', '3', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('102', '104', '1', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('102', '105', '4', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('102', '116', '2', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('102', '119', '5', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('103', '1', '0', '{\"collapsed\":\"1\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('103', '100', '1', '{\"label\":\"Fill field\",\"maxlength\":2048}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('104', '92', '0', '{\"label\":\"E-mail address\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('104', '100', '1', '{\"label\":\"Phone\",\"maxlength\":2048}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('104', '101', '3', '{\"label\":\"Company map\",\"rows\":5}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('104', '110', '2', '{\"label\":\"Address\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('105', '112', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('106', '100', '0', '{\"label\":\"Name\",\"maxlength\":2048}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('106', '113', '1', '{\"label\":\"URL\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('106', '114', '2', '{\"label\":\"Open in a new window\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('107', '105', '2', '{\"showIf\":\"cbox_1=1\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('107', '114', '0', '{\"label\":\"Enable notifications\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('107', '115', '3', '{\"notes\":\"If no page is selected, the notification will appear on all pages.\",\"showIf\":\"cbox_1=1\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('107', '117', '1', '{\"initValue\":\"3\",\"label\":\"Select an alert type\",\"required\":1,\"showIf\":\"cbox_1=1\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('108', '1', '0', '{\"collapsed\":\"8\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('108', '102', '1', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('109', '1', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('109', '118', '1', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('110', '105', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('111', '1', '1', '{\"showIf\":\"cbox=0\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('111', '102', '7', '{\"columnWidth\":40}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('111', '105', '6', '{\"columnWidth\":60}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('111', '113', '3', '{\"columnWidth\":50,\"label\":\"URL\",\"showIf\":\"cbox=0, cbox_1=1\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('111', '114', '2', '{\"columnWidth\":20,\"label\":\"Title as link\",\"showIf\":\"cbox=0\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('111', '120', '5', '{\"label\":\"Title image\",\"showIf\":\"cbox=0\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('111', '121', '4', '{\"columnWidth\":30,\"label\":\"Open in a new window\",\"notes\":\"target = _blank\",\"showIf\":\"cbox=0, cbox_1=1\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('111', '128', '0', '{\"label\":\"Hide title\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('112', '1', '1', '{\"showIf\":\"cbox_1=0\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('112', '101', '6', '{\"label\":\"Put code\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('112', '102', '3', '{\"collapsed\":\"2\",\"columnWidth\":40}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('112', '105', '2', '{\"collapsed\":\"2\",\"columnWidth\":60}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('112', '114', '0', '{\"label\":\"Hide title\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('112', '122', '4', '{\"label\":\"Select Language\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('112', '123', '5', '{\"label\":\"Select Theme\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('113', '1', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('113', '102', '3', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('113', '104', '1', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('113', '105', '4', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('113', '116', '2', '{\"description\":\"This notification will overwrite the main one which is on the home page\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('114', '1', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('114', '102', '3', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('114', '104', '1', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('114', '105', '4', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('114', '116', '2', '{\"description\":\"This notification will overwrite the main one which is on the home page\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('114', '119', '5', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('115', '1', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('115', '102', '3', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('115', '104', '1', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('115', '105', '4', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('115', '116', '2', '{\"description\":\"This notification will overwrite the main one which is on the home page\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('116', '1', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('116', '102', '7', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('116', '104', '1', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('116', '105', '8', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('116', '114', '10', '{\"label\":\"Close comments\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('116', '116', '2', '{\"description\":\"This notification will overwrite the main one which is on the home page\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('116', '119', '9', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('116', '124', '5', '{\"showIf\":\"cbox=1\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('116', '125', '11', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('116', '126', '6', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('116', '127', '3', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('116', '128', '4', '{\"description\":\"This will publish the page using `LazyCron`\",\"label\":\"Publish Post on date\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('117', '1', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('117', '102', '3', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('117', '104', '1', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('117', '105', '4', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('117', '116', '2', '{\"description\":\"This notification will overwrite the main one which is on the home page\"}');
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('117', '119', '5', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('119', '1', '0', NULL);
INSERT INTO `fieldgroups_fields` (`fieldgroups_id`, `fields_id`, `sort`, `data`) VALUES('120', '1', '0', NULL);

DROP TABLE IF EXISTS `fields`;
CREATE TABLE `fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(128) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `name` varchar(191) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `flags` int(11) NOT NULL DEFAULT 0,
  `label` varchar(191) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=133 DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('1', 'FieldtypePageTitle', 'title', '13', 'Title', '{\"required\":1,\"textformatters\":[\"TextformatterEntities\"],\"size\":0,\"maxlength\":255,\"icon\":\"circle-o\",\"collapsed\":0,\"minlength\":0,\"showCount\":0}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('2', 'FieldtypeModule', 'process', '25', 'Process', '{\"description\":\"The process that is executed on this page. Since this is mostly used by ProcessWire internally, it is recommended that you don\'t change the value of this unless adding your own pages in the admin.\",\"collapsed\":1,\"required\":1,\"moduleTypes\":[\"Process\"],\"permanent\":1}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('3', 'FieldtypePassword', 'pass', '24', 'Set Password', '{\"collapsed\":1,\"size\":50,\"maxlength\":128}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('4', 'FieldtypePage', 'roles', '24', 'Roles', '{\"derefAsPage\":0,\"parent_id\":30,\"labelFieldName\":\"name\",\"inputfield\":\"InputfieldCheckboxes\",\"description\":\"User will inherit the permissions assigned to each role. You may assign multiple roles to a user. When accessing a page, the user will only inherit permissions from the roles that are also assigned to the page\'s template.\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('5', 'FieldtypePage', 'permissions', '24', 'Permissions', '{\"derefAsPage\":0,\"parent_id\":31,\"labelFieldName\":\"title\",\"inputfield\":\"InputfieldCheckboxes\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('92', 'FieldtypeEmail', 'email', '9', 'E-Mail Address', '{\"size\":70,\"maxlength\":255}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('97', 'FieldtypeModule', 'admin_theme', '8', 'Admin Theme', '{\"moduleTypes\":[\"AdminTheme\"],\"labelField\":\"title\",\"inputfieldClass\":\"InputfieldRadios\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('98', 'FieldtypeFieldsetPage', 'opt', '0', 'Basic Options', '{\"template_id\":43,\"parent_id\":1022,\"repeaterLoading\":2,\"repeaterMaxItems\":1,\"repeaterMinItems\":1,\"repeaterFields\":[100,101,102],\"collapsed\":0,\"icon\":\"cog\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('99', 'FieldtypeText', 'titleTag', '0', 'Title tag', '{\"textformatters\":[\"TextformatterEntities\"],\"collapsed\":0,\"minlength\":0,\"maxlength\":60,\"showCount\":1,\"size\":0,\"tags\":\"seo\",\"icon\":\"circle-thin\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('100', 'FieldtypeText', 'txt_1', '0', 'txt_1', '{\"textformatters\":[\"TextformatterEntities\"],\"icon\":\"text-height\",\"collapsed\":0,\"minlength\":0,\"maxlength\":2048,\"showCount\":0,\"size\":0}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('101', 'FieldtypeTextarea', 'txtarea_1', '0', 'txtarea_1', '{\"icon\":\"text-width\",\"inputfieldClass\":\"InputfieldTextarea\",\"contentType\":0,\"collapsed\":0,\"minlength\":0,\"maxlength\":0,\"showCount\":0,\"rows\":5,\"textformatters\":[\"TextformatterEntities\"]}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('102', 'FieldtypeImage', 'images', '0', 'images', '{\"fileSchema\":271,\"maxFiles\":0,\"textformatters\":[\"TextformatterEntities\"],\"extensions\":\"gif jpg jpeg png svg ico\",\"outputFormat\":0,\"descriptionRows\":1,\"useTags\":9,\"gridMode\":\"grid\",\"focusMode\":\"on\",\"resizeServer\":0,\"clientQuality\":90,\"maxReject\":0,\"dimensionsByAspectRatio\":0,\"defaultValuePage\":0,\"inputfieldClass\":\"InputfieldImage\",\"collapsed\":0,\"allowContexts\":[\"useTags\",\"tagsList\"],\"icon\":\"file-image-o\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('103', 'FieldtypeTextarea', 'metaDescription', '0', 'Meta description', '{\"textformatters\":[\"TextformatterEntities\"],\"inputfieldClass\":\"InputfieldTextarea\",\"contentType\":0,\"collapsed\":0,\"minlength\":0,\"maxlength\":160,\"showCount\":1,\"rows\":2,\"icon\":\"circle-o\",\"tags\":\"seo\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('104', 'FieldtypeFieldsetPage', 'seo', '0', 'SEO', '{\"template_id\":44,\"parent_id\":1024,\"repeaterLoading\":2,\"repeaterMaxItems\":1,\"repeaterMinItems\":1,\"repeaterFields\":[99,103],\"collapsed\":20,\"tags\":\"seo\",\"icon\":\"dot-circle-o\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('105', 'FieldtypeTextarea', 'body', '0', 'Body', '{\"inputfieldClass\":\"InputfieldTinyMCE\",\"contentType\":1,\"inlineMode\":1,\"height\":500,\"lazyMode\":1,\"features\":[\"toolbar\",\"menubar\",\"stickybars\",\"purifier\",\"imgUpload\",\"imgResize\",\"pasteFilter\"],\"toolbar\":\"styles bold italic pwlink unlink pwimage blockquote hr bullist numlist table anchor code\",\"plugins\":[\"anchor\",\"code\",\"link\",\"lists\",\"pwimage\",\"pwlink\",\"searchreplace\",\"table\",\"wordcount\"],\"collapsed\":0,\"minlength\":0,\"maxlength\":0,\"showCount\":0,\"rows\":15,\"htmlOptions\":[2,4,8,16,32],\"icon\":\"book\",\"textformatters\":[\"TextformatterEmoji\"]}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('107', 'FieldtypePage', 'adv_opt', '0', 'Advanced options', '{\"derefAsPage\":0,\"inputfield\":\"InputfieldAsmSelect\",\"distinctAutojoin\":true,\"icon\":\"cog\",\"usePageEdit\":1,\"parent_id\":1029,\"labelFieldName\":\"title\",\"collapsed\":0,\"template_id\":45,\"template_ids\":[49]}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('108', 'FieldtypePage', 'social_profiles', '0', 'Social Profiles', '{\"derefAsPage\":0,\"inputfield\":\"InputfieldAsmSelect\",\"distinctAutojoin\":true,\"usePageEdit\":1,\"parent_id\":1041,\"labelFieldName\":\"title\",\"collapsed\":0,\"icon\":\"angellist\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('109', 'FieldtypeFieldsetPage', 'contact_info', '0', 'Contact info', '{\"template_id\":50,\"parent_id\":1050,\"repeaterLoading\":2,\"repeaterMaxItems\":1,\"repeaterMinItems\":1,\"collapsed\":0,\"repeaterFields\":[92,100,110,101],\"tags\":\"contact\",\"icon\":\"paper-plane-o\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('110', 'FieldtypeText', 'txt_2', '0', 'txt_2', '{\"textformatters\":[\"TextformatterEntities\"],\"collapsed\":0,\"minlength\":0,\"maxlength\":2048,\"showCount\":0,\"size\":0,\"icon\":\"text-height\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('111', 'FieldtypeRepeater', 'useful_links', '0', 'Useful Links', '{\"template_id\":51,\"parent_id\":1052,\"icon\":\"link\",\"familyFriendly\":0,\"familyToggle\":0,\"repeaterCollapse\":0,\"repeaterLoading\":1,\"rememberOpen\":0,\"accordionMode\":0,\"loudControls\":0,\"noScroll\":0,\"collapsed\":0,\"repeaterFields\":[112],\"tags\":\"site_links\",\"repeaterTitle\":\"{link.txt_1}\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('112', 'FieldtypeFieldsetPage', 'link', '0', 'link', '{\"template_id\":52,\"parent_id\":1053,\"repeaterLoading\":2,\"repeaterMaxItems\":1,\"repeaterMinItems\":1,\"repeaterFields\":[100,113,114],\"collapsed\":0,\"icon\":\"rocket\",\"tags\":\"site_links\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('113', 'FieldtypeURL', 'url_1', '0', 'url_1', '{\"textformatters\":[\"TextformatterEntities\"],\"noRelative\":0,\"allowIDN\":0,\"allowQuotes\":0,\"addRoot\":0,\"collapsed\":0,\"minlength\":0,\"maxlength\":1024,\"showCount\":0,\"size\":0,\"icon\":\"link\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('114', 'FieldtypeCheckbox', 'cbox_1', '0', 'cbox_1', '{\"collapsed\":0,\"icon\":\"check-square-o\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('115', 'FieldtypePage', 'site_pages', '0', 'Select Pages', '{\"derefAsPage\":0,\"inputfield\":\"InputfieldPageListSelectMultiple\",\"distinctAutojoin\":true,\"usePageEdit\":0,\"parent_id\":0,\"labelFieldName\":\"title\",\"collapsed\":0,\"tags\":\"site_links\",\"icon\":\"tree\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('116', 'FieldtypeFieldsetPage', 'guest_notification', '0', 'Guest notification', '{\"template_id\":53,\"parent_id\":1071,\"repeaterLoading\":2,\"repeaterMaxItems\":1,\"repeaterMinItems\":1,\"repeaterFields\":[114,117,105,115],\"collapsed\":21,\"icon\":\"bullhorn\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('117', 'FieldtypeOptions', 'alerts', '0', 'Alerts', '{\"inputfieldClass\":\"InputfieldRadios\",\"collapsed\":0,\"optionColumns\":0,\"allowContexts\":[\"initValue\",\"defaultValue\"],\"icon\":\"bell-o\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('118', 'FieldtypeImage', 'block_images', '0', 'Images', '{\"fileSchema\":271,\"maxFiles\":0,\"textformatters\":[\"TextformatterEntities\"],\"extensions\":\"gif jpg jpeg png svg png\",\"outputFormat\":0,\"descriptionRows\":1,\"useTags\":9,\"gridMode\":\"grid\",\"focusMode\":\"on\",\"resizeServer\":0,\"clientQuality\":90,\"maxReject\":0,\"dimensionsByAspectRatio\":0,\"defaultValuePage\":0,\"inputfieldClass\":\"InputfieldImage\",\"icon\":\"cube\",\"collapsed\":0,\"tags\":\"blocks\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('119', 'FieldtypePageTable', 'content_blocks', '0', 'Content blocks', '{\"template_id\":[57,55,58],\"parent_id\":1077,\"trashOnDelete\":1,\"unpubOnTrash\":1,\"unpubOnUnpub\":1,\"collapsed\":0,\"noclose\":0,\"icon\":\"cubes\",\"columns\":\"template.label\\ntitle\",\"tags\":\"blocks\",\"nameFormat\":\"Ymd:His\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('120', 'FieldtypeImage', 'image', '0', 'Image', '{\"fileSchema\":270,\"maxFiles\":1,\"textformatters\":[\"TextformatterEntities\"],\"extensions\":\"gif jpg jpeg png svg\",\"outputFormat\":0,\"descriptionRows\":1,\"useTags\":0,\"gridMode\":\"grid\",\"focusMode\":\"on\",\"resizeServer\":0,\"clientQuality\":90,\"maxReject\":0,\"dimensionsByAspectRatio\":0,\"defaultValuePage\":0,\"inputfieldClass\":\"InputfieldImage\",\"icon\":\"file-image-o\",\"collapsed\":0}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('121', 'FieldtypeCheckbox', 'cbox_2', '0', 'cbox_2', '{\"icon\":\"check-square-o\",\"collapsed\":0}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('122', 'FieldtypeOptions', 'lang', '0', 'Lang', '{\"inputfieldClass\":\"InputfieldSelect\",\"collapsed\":1,\"optionColumns\":0,\"tags\":\"phiki\",\"icon\":\"code\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('123', 'FieldtypeOptions', 'theme', '0', 'Theme', '{\"inputfieldClass\":\"InputfieldRadios\",\"collapsed\":1,\"optionColumns\":0,\"tags\":\"phiki\",\"icon\":\"delicious\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('124', 'FieldtypeDatetime', 'date', '0', 'Date', '{\"dateOutputFormat\":\"m\\/d\\/y g:i a\",\"dateInputFormat\":\"Y-m-d\",\"timeInputFormat\":\"g:i a\",\"inputType\":\"html\",\"htmlType\":\"datetime\",\"icon\":\"calendar\",\"collapsed\":0,\"dateSelectFormat\":\"yMd\",\"yearFrom\":1925,\"yearTo\":2045,\"yearLock\":0,\"datepicker\":0,\"timeInputSelect\":0,\"size\":25,\"showAnim\":\"fade\",\"numberOfMonths\":1,\"changeMonth\":1,\"changeYear\":1,\"showButtonPanel\":0,\"showMonthAfterYear\":0,\"showOtherMonths\":0,\"defaultToday\":1}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('125', 'FieldtypeComments', 'comments', '0', 'Comments', '{\"schemaVersion\":8,\"icon\":\"comment-o\",\"moderate\":0,\"useNotify\":0,\"useNotifyText\":1,\"deleteSpamDays\":3,\"depth\":0,\"dateFormat\":\"relative\",\"useVotes\":0,\"useStars\":0,\"useManager\":1,\"collapsed\":0,\"redirectAfterPost\":1,\"quietSave\":1}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('126', 'FieldtypePage', 'categories', '0', 'Categories', '{\"derefAsPage\":0,\"inputfield\":\"InputfieldAsmSelect\",\"distinctAutojoin\":true,\"usePageEdit\":1,\"parent_id\":1094,\"template_id\":61,\"labelFieldName\":\"title\",\"collapsed\":0,\"icon\":\"th-large\",\"addable\":1}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('127', 'FieldtypeInteger', 'likes', '0', 'likes', '{\"zeroNotEmpty\":0,\"collapsed\":0,\"inputType\":\"text\",\"size\":10,\"icon\":\"thumbs-o-up\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('128', 'FieldtypeCheckbox', 'cbox', '0', 'cbox', '{\"icon\":\"toggle-on\",\"collapsed\":0}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('129', 'FieldtypeInteger', 'int', '0', 'int', '{\"zeroNotEmpty\":0,\"collapsed\":0,\"inputType\":\"text\",\"size\":10,\"icon\":\"sort-numeric-asc\"}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('131', 'FieldtypeFieldsetOpen', 'fieldset_p', '0', 'fieldset_p', '{\"closeFieldID\":132,\"icon\":\"folder-o\",\"collapsed\":0}');
INSERT INTO `fields` (`id`, `type`, `name`, `flags`, `label`, `data`) VALUES('132', 'FieldtypeFieldsetClose', 'fieldset_p_END', '0', 'Close an open fieldset', '{\"description\":\"This field was added automatically to accompany fieldset \'fieldset_p\'.  It should be placed in your template\\/fieldgroup wherever you want the fieldset to end.\",\"openFieldID\":131}');

DROP TABLE IF EXISTS `fieldtype_options`;
CREATE TABLE `fieldtype_options` (
  `fields_id` int(10) unsigned NOT NULL,
  `option_id` int(10) unsigned NOT NULL,
  `title` text DEFAULT NULL,
  `value` varchar(171) DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL,
  PRIMARY KEY (`fields_id`,`option_id`),
  UNIQUE KEY `title` (`title`(171),`fields_id`),
  KEY `value` (`value`,`fields_id`),
  KEY `sort` (`sort`,`fields_id`),
  FULLTEXT KEY `title_ft` (`title`),
  FULLTEXT KEY `value_ft` (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('117', '1', 'error', '', '0');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('117', '2', 'warning', '', '1');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('117', '3', 'success', '', '2');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('117', '4', 'primary', '', '3');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('117', '5', 'secondary', '', '4');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('117', '6', 'accent', '', '5');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '1', 'Txt', '', '0');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '2', 'Astro', '', '1');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '3', 'Hy', '', '2');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '4', 'Nim', '', '3');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '5', 'Cpp', '', '4');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '6', 'Jinja', '', '5');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '7', 'Coq', '', '6');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '8', 'Templ', '', '7');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '9', 'GlimmerTs', '', '8');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '10', 'AngularHtml', '', '9');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '11', 'Cmake', '', '10');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '12', 'Mdx', '', '11');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '13', 'Nix', '', '12');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '14', 'Gdresource', '', '13');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '15', 'Haxe', '', '14');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '16', 'Ada', '', '15');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '17', 'Powerquery', '', '16');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '18', 'Fluent', '', '17');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '19', 'ObjectiveC', '', '18');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '20', 'Elixir', '', '19');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '21', 'Diff', '', '20');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '22', 'Java', '', '21');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '23', 'Glsl', '', '22');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '24', 'Mojo', '', '23');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '25', 'Sparql', '', '24');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '26', 'Bicep', '', '25');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '27', 'Csv', '', '26');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '28', 'Swift', '', '27');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '29', 'SshConfig', '', '28');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '30', 'Edge', '', '29');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '31', 'Narrat', '', '30');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '32', 'Tasl', '', '31');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '33', 'Nushell', '', '32');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '34', 'Erb', '', '33');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '35', 'Move', '', '34');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '36', 'Scheme', '', '35');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '37', 'Mipsasm', '', '36');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '38', 'Rst', '', '37');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '39', 'Shellscript', '', '38');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '40', 'Apache', '', '39');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '41', 'Wgsl', '', '40');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '42', 'FortranFreeForm', '', '41');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '43', 'Ini', '', '42');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '44', 'Make', '', '43');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '45', 'TsTags', '', '44');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '46', 'Stylus', '', '45');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '47', 'Jsx', '', '46');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '48', 'Jsonl', '', '47');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '49', 'Twig', '', '48');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '50', 'Clojure', '', '49');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '51', 'Svelte', '', '50');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '52', 'Xml', '', '51');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '53', 'Jssm', '', '52');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '54', 'Erlang', '', '53');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '55', 'Applescript', '', '54');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '56', 'Viml', '', '55');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '57', 'Razor', '', '56');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '58', 'Apex', '', '57');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '59', 'Berry', '', '58');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '60', 'DreamMaker', '', '59');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '61', 'Wolfram', '', '60');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '62', 'Cobol', '', '61');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '63', 'Proto', '', '62');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '64', 'Genie', '', '63');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '65', 'Wasm', '', '64');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '66', 'Handlebars', '', '65');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '67', 'Zig', '', '66');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '68', 'Vhdl', '', '67');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '69', 'Go', '', '68');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '70', 'Fish', '', '69');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '71', 'Solidity', '', '70');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '72', 'Sas', '', '71');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '73', 'FortranFixedForm', '', '72');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '74', 'R', '', '73');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '75', 'Fennel', '', '74');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '76', 'Ruby', '', '75');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '77', 'Log', '', '76');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '78', 'Vala', '', '77');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '79', 'Splunk', '', '78');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '80', 'Lua', '', '79');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '81', 'Gnuplot', '', '80');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '82', 'Regexp', '', '81');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '83', 'Markdown', '', '82');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '84', 'Ballerina', '', '83');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '85', 'Xsl', '', '84');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '86', 'Systemd', '', '85');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '87', 'Coffee', '', '86');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '88', 'Haml', '', '87');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '89', 'Wikitext', '', '88');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '90', 'Kusto', '', '89');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '91', 'Ocaml', '', '90');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '92', 'Cue', '', '91');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '93', 'Nextflow', '', '92');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '94', 'GitRebase', '', '93');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '95', 'Cypher', '', '94');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '96', 'Tsx', '', '95');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '97', 'Bibtex', '', '96');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '98', 'Pug', '', '97');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '99', 'GlimmerJs', '', '98');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '100', 'Julia', '', '99');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '101', 'Beancount', '', '100');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '102', 'Puppet', '', '101');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '103', 'Bsl', '', '102');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '104', 'Http', '', '103');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '105', 'Csharp', '', '104');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '106', 'Jison', '', '105');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '107', 'Purescript', '', '106');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '108', 'Actionscript3', '', '107');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '109', 'Shellsession', '', '108');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '110', 'SystemVerilog', '', '109');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '111', 'Gdscript', '', '110');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '112', 'Luau', '', '111');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '113', 'Toml', '', '112');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '114', 'Php', '', '113');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '115', 'Typst', '', '114');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '116', 'Postcss', '', '115');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '117', 'Prisma', '', '116');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '118', 'Fsharp', '', '117');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '119', 'Apl', '', '118');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '120', 'Sql', '', '119');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '121', 'ObjectiveCpp', '', '120');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '122', 'Logo', '', '121');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '123', 'Blade', '', '122');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '124', 'Yaml', '', '123');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '125', 'Scala', '', '124');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '126', 'Codeql', '', '125');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '127', 'Crystal', '', '126');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '128', 'Sdbl', '', '127');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '129', 'Hjson', '', '128');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '130', 'Awk', '', '129');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '131', 'Docker', '', '130');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '132', 'Dax', '', '131');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '133', 'AngularTs', '', '132');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '134', 'Terraform', '', '133');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '135', 'Typespec', '', '134');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '136', 'Codeowners', '', '135');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '137', 'Rel', '', '136');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '138', 'VueHtml', '', '137');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '139', 'Abap', '', '138');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '140', 'GitCommit', '', '139');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '141', 'Rust', '', '140');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '142', 'Polar', '', '141');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '143', 'Javascript', '', '142');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '144', 'Prolog', '', '143');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '145', 'Dart', '', '144');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '146', 'Marko', '', '145');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '147', 'Asciidoc', '', '146');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '148', 'Wenyan', '', '147');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '149', 'Elm', '', '148');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '150', 'D', '', '149');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '151', 'Hlsl', '', '150');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '152', 'Po', '', '151');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '153', 'Shaderlab', '', '152');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '154', 'Stata', '', '153');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '155', 'Nginx', '', '154');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '156', 'Ara', '', '155');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '157', 'Json', '', '156');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '158', 'Css', '', '157');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '159', 'Tsv', '', '158');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '160', 'Vb', '', '159');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '161', 'Hcl', '', '160');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '162', 'Plsql', '', '161');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '163', 'Pascal', '', '162');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '164', 'C', '', '163');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '165', 'Turtle', '', '164');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '166', 'Qmldir', '', '165');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '167', 'JinjaHtml', '', '166');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '168', 'Racket', '', '167');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '169', 'Scss', '', '168');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '170', 'Hxml', '', '169');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '171', 'Qml', '', '170');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '172', 'CommonLisp', '', '171');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '173', 'Lean', '', '172');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '174', 'Tex', '', '173');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '175', 'Jsonnet', '', '174');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '176', 'Vyper', '', '175');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '177', 'Html', '', '176');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '178', 'Liquid', '', '177');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '179', 'EmacsLisp', '', '178');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '180', 'V', '', '179');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '181', 'Hack', '', '180');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '182', 'Latex', '', '181');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '183', 'Perl', '', '182');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '184', 'Gleam', '', '183');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '185', 'Cairo', '', '184');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '186', 'Matlab', '', '185');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '187', 'Jsonc', '', '186');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '188', 'Dotenv', '', '187');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '189', 'Raku', '', '188');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '190', 'Less', '', '189');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '191', 'Bat', '', '190');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '192', 'Clarity', '', '191');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '193', 'Reg', '', '192');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '194', 'CppMacro', '', '193');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '195', 'Tcl', '', '194');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '196', 'HtmlDerivative', '', '195');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '197', 'Powershell', '', '196');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '198', 'Graphql', '', '197');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '199', 'Haskell', '', '198');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '200', 'Gdshader', '', '199');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '201', 'Groovy', '', '200');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '202', 'Qss', '', '201');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '203', 'Verilog', '', '202');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '204', 'Typescript', '', '203');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '205', 'Kotlin', '', '204');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '206', 'Gherkin', '', '205');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '207', 'Soy', '', '206');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '208', 'Python', '', '207');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '209', 'Sass', '', '208');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '210', 'Talonscript', '', '209');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '211', 'Vue', '', '210');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '212', 'Zenscript', '', '211');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '213', 'Imba', '', '212');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '214', 'Riscv', '', '213');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '215', 'Smalltalk', '', '214');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '216', 'Json5', '', '215');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '217', 'Cadence', '', '216');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '218', 'Desktop', '', '217');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '219', 'Asm', '', '218');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('122', '220', 'Antlers', '', '219');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '1', 'OneDarkPro', '', '0');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '2', 'SolarizedLight', '', '1');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '3', 'VitesseBlack', '', '2');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '4', 'GithubLightDefault', '', '3');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '5', 'SlackDark', '', '4');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '6', 'EverforestDark', '', '5');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '7', 'RosePineMoon', '', '6');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '8', 'EverforestLight', '', '7');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '9', 'Laserwave', '', '8');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '10', 'GithubLightHighContrast', '', '9');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '11', 'CatppuccinMocha', '', '10');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '12', 'Red', '', '11');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '13', 'MaterialThemeLighter', '', '12');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '14', 'OneLight', '', '13');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '15', 'AuroraX', '', '14');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '16', 'TokyoNight', '', '15');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '17', 'CatppuccinMacchiato', '', '16');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '18', 'GithubDark', '', '17');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '19', 'RosePineDawn', '', '18');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '20', 'Poimandres', '', '19');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '21', 'GithubDarkHighContrast', '', '20');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '22', 'MaterialTheme', '', '21');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '23', 'Dracula', '', '22');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '24', 'GithubDarkDefault', '', '23');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '25', 'GithubDarkDimmed', '', '24');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '26', 'RosePine', '', '25');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '27', 'KanagawaLotus', '', '26');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '28', 'KanagawaDragon', '', '27');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '29', 'DarkPlus', '', '28');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '30', 'AyuDark', '', '29');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '31', 'MinDark', '', '30');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '32', 'Monokai', '', '31');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '33', 'Nord', '', '32');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '34', 'CatppuccinFrappe', '', '33');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '35', 'GithubLight', '', '34');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '36', 'DraculaSoft', '', '35');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '37', 'Synthwave84', '', '36');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '38', 'VitesseDark', '', '37');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '39', 'Andromeeda', '', '38');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '40', 'LightPlus', '', '39');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '41', 'SlackOchin', '', '40');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '42', 'SolarizedDark', '', '41');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '43', 'MaterialThemeOcean', '', '42');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '44', 'VitesseLight', '', '43');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '45', 'Vesper', '', '44');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '46', 'KanagawaWave', '', '45');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '47', 'Plastic', '', '46');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '48', 'MaterialThemeDarker', '', '47');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '49', 'NightOwl', '', '48');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '50', 'CatppuccinLatte', '', '49');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '51', 'MinLight', '', '50');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '52', 'SnazzyLight', '', '51');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '53', 'Houston', '', '52');
INSERT INTO `fieldtype_options` (`fields_id`, `option_id`, `title`, `value`, `sort`) VALUES('123', '54', 'MaterialThemePalenight', '', '53');

DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class` varchar(128) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `flags` int(11) NOT NULL DEFAULT 0,
  `data` mediumtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `class` (`class`)
) ENGINE=MyISAM AUTO_INCREMENT=6043 DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('1', 'FieldtypeTextarea', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('3', 'FieldtypeText', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('4', 'FieldtypePage', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('6', 'FieldtypeFile', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('7', 'ProcessPageEdit', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('10', 'ProcessLogin', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('12', 'ProcessPageList', '0', '{\"pageLabelField\":\"title\",\"paginationLimit\":25,\"limit\":50}', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('14', 'ProcessPageSort', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('15', 'InputfieldPageListSelect', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('17', 'ProcessPageAdd', '0', '{\"shortcutSort\":[62,61],\"bookmarks\":{\"_0\":[]}}', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('25', 'InputfieldAsmSelect', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('27', 'FieldtypeModule', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('28', 'FieldtypeDatetime', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('29', 'FieldtypeEmail', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('30', 'InputfieldForm', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('32', 'InputfieldSubmit', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('34', 'InputfieldText', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('35', 'InputfieldTextarea', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('36', 'InputfieldSelect', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('37', 'InputfieldCheckbox', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('38', 'InputfieldCheckboxes', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('39', 'InputfieldRadios', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('40', 'InputfieldHidden', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('41', 'InputfieldName', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('43', 'InputfieldSelectMultiple', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('45', 'JqueryWireTabs', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('47', 'ProcessTemplate', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('48', 'ProcessField', '32', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('50', 'ProcessModule', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('55', 'InputfieldFile', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('56', 'InputfieldImage', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('57', 'FieldtypeImage', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('60', 'InputfieldPage', '0', '{\"inputfieldClasses\":[\"InputfieldSelect\",\"InputfieldSelectMultiple\",\"InputfieldCheckboxes\",\"InputfieldRadios\",\"InputfieldAsmSelect\",\"InputfieldPageListSelect\",\"InputfieldPageListSelectMultiple\",\"InputfieldPageAutocomplete\"]}', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('61', 'TextformatterEntities', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('66', 'ProcessUser', '0', '{\"showFields\":[\"name\",\"email\",\"roles\"]}', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('67', 'MarkupAdminDataTable', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('68', 'ProcessRole', '0', '{\"showFields\":[\"name\"]}', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('76', 'ProcessList', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('78', 'InputfieldFieldset', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('79', 'InputfieldMarkup', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('80', 'InputfieldEmail', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('83', 'ProcessPageView', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('84', 'FieldtypeInteger', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('85', 'InputfieldInteger', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('86', 'InputfieldPageName', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('87', 'ProcessHome', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('89', 'FieldtypeFloat', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('90', 'InputfieldFloat', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('94', 'InputfieldDatetime', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('97', 'FieldtypeCheckbox', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('98', 'MarkupPagerNav', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('103', 'JqueryTableSorter', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('104', 'ProcessPageSearch', '1', '{\"searchFields\":\"title\",\"displayField\":\"title path\"}', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('105', 'FieldtypeFieldsetOpen', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('106', 'FieldtypeFieldsetClose', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('107', 'FieldtypeFieldsetTabOpen', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('108', 'InputfieldURL', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('109', 'ProcessPageTrash', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('111', 'FieldtypePageTitle', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('112', 'InputfieldPageTitle', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('113', 'MarkupPageArray', '3', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('114', 'PagePermissions', '3', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('115', 'PageRender', '3', '{\"clearCache\":1}', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('116', 'JqueryCore', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('117', 'JqueryUI', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('121', 'ProcessPageEditLink', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('122', 'InputfieldPassword', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('125', 'SessionLoginThrottle', '11', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('129', 'ProcessPageEditImageSelect', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('131', 'InputfieldButton', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('133', 'FieldtypePassword', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('134', 'ProcessPageType', '33', '{\"showFields\":[]}', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('135', 'FieldtypeURL', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('136', 'ProcessPermission', '1', '{\"showFields\":[\"name\",\"title\"]}', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('137', 'InputfieldPageListSelectMultiple', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('138', 'ProcessProfile', '1', '{\"profileFields\":[\"pass\",\"email\",\"admin_theme\"]}', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('139', 'SystemUpdater', '1', '{\"systemVersion\":20,\"coreVersion\":\"3.0.247\"}', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('148', 'AdminThemeDefault', '10', '{\"colors\":\"classic\"}', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('149', 'InputfieldSelector', '42', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('150', 'ProcessPageLister', '32', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('151', 'JqueryMagnific', '1', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('155', 'InputfieldTinyMCE', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('156', 'MarkupHTMLPurifier', '0', '', '2025-02-15 20:49:57');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('159', '.Modules.wire/modules/', '8192', 'Markup/MarkupRSS.module\nMarkup/MarkupPagerNav/MarkupPagerNav.module\nMarkup/MarkupHTMLPurifier/MarkupHTMLPurifier.module\nMarkup/MarkupCache.module\nMarkup/MarkupPageArray.module\nMarkup/MarkupPageFields.module\nMarkup/MarkupAdminDataTable/MarkupAdminDataTable.module\nJquery/JqueryUI/JqueryUI.module\nJquery/JqueryTableSorter/JqueryTableSorter.module\nJquery/JqueryWireTabs/JqueryWireTabs.module\nJquery/JqueryMagnific/JqueryMagnific.module\nJquery/JqueryCore/JqueryCore.module\nLazyCron.module\nSession/SessionLoginThrottle/SessionLoginThrottle.module\nSession/SessionHandlerDB/SessionHandlerDB.module\nSession/SessionHandlerDB/ProcessSessionDB.module\nTextformatter/TextformatterNewlineUL.module\nTextformatter/TextformatterEntities.module\nTextformatter/TextformatterMarkdownExtra/TextformatterMarkdownExtra.module\nTextformatter/TextformatterStripTags.module\nTextformatter/TextformatterNewlineBR.module\nTextformatter/TextformatterSmartypants/TextformatterSmartypants.module\nTextformatter/TextformatterPstripper.module\nSystem/SystemUpdater/SystemUpdater.module\nSystem/SystemNotifications/SystemNotifications.module\nSystem/SystemNotifications/FieldtypeNotifications.module\nPagePaths.module\nFileCompilerTags.module\nPagePathHistory.module\nProcess/ProcessLogin/ProcessLogin.module\nProcess/ProcessPageView.module\nProcess/ProcessPageEdit/ProcessPageEdit.module\nProcess/ProcessPageList/ProcessPageList.module\nProcess/ProcessPageTrash.module\nProcess/ProcessPageEditImageSelect/ProcessPageEditImageSelect.module\nProcess/ProcessPageAdd/ProcessPageAdd.module\nProcess/ProcessPageEditLink/ProcessPageEditLink.module\nProcess/ProcessModule/ProcessModule.module\nProcess/ProcessTemplate/ProcessTemplate.module\nProcess/ProcessPageSort.module\nProcess/ProcessPageType/ProcessPageType.module\nProcess/ProcessList.module\nProcess/ProcessPermission/ProcessPermission.module\nProcess/ProcessPageClone.module\nProcess/ProcessHome.module\nProcess/ProcessPageSearch/ProcessPageSearch.module\nProcess/ProcessLogger/ProcessLogger.module\nProcess/ProcessPageLister/ProcessPageLister.module\nProcess/ProcessUser/ProcessUser.module\nProcess/ProcessForgotPassword/ProcessForgotPassword.module\nProcess/ProcessProfile/ProcessProfile.module\nProcess/ProcessRole/ProcessRole.module\nProcess/ProcessCommentsManager/ProcessCommentsManager.module\nProcess/ProcessField/ProcessField.module\nProcess/ProcessPagesExportImport/ProcessPagesExportImport.module\nProcess/ProcessRecentPages/ProcessRecentPages.module\nPageRender.module\nImage/ImageSizerEngineAnimatedGif/ImageSizerEngineAnimatedGif.module\nImage/ImageSizerEngineIMagick/ImageSizerEngineIMagick.module\nInputfield/InputfieldIcon/InputfieldIcon.module\nInputfield/InputfieldSelectMultiple.module\nInputfield/InputfieldAsmSelect/InputfieldAsmSelect.module\nInputfield/InputfieldPageTitle/InputfieldPageTitle.module\nInputfield/InputfieldName.module\nInputfield/InputfieldCheckbox/InputfieldCheckbox.module\nInputfield/InputfieldPassword/InputfieldPassword.module\nInputfield/InputfieldRadios/InputfieldRadios.module\nInputfield/InputfieldMarkup.module\nInputfield/InputfieldURL.module\nInputfield/InputfieldPageName/InputfieldPageName.module\nInputfield/InputfieldImage/InputfieldImage.module\nInputfield/InputfieldTextarea.module\nInputfield/InputfieldPageListSelect/InputfieldPageListSelectMultiple.module\nInputfield/InputfieldPageListSelect/InputfieldPageListSelect.module\nInputfield/InputfieldSelector/InputfieldSelector.module\nInputfield/InputfieldText/InputfieldText.module\nInputfield/InputfieldSelect.module\nInputfield/InputfieldSubmit/InputfieldSubmit.module\nInputfield/InputfieldFloat.module\nInputfield/InputfieldEmail.module\nInputfield/InputfieldDatetime/InputfieldDatetime.module\nInputfield/InputfieldButton.module\nInputfield/InputfieldForm.module\nInputfield/InputfieldPage/InputfieldPage.module\nInputfield/InputfieldPageTable/InputfieldPageTable.module\nInputfield/InputfieldInteger.module\nInputfield/InputfieldCheckboxes/InputfieldCheckboxes.module\nInputfield/InputfieldTinyMCE/InputfieldTinyMCE.module.php\nInputfield/InputfieldToggle/InputfieldToggle.module\nInputfield/InputfieldFile/InputfieldFile.module\nInputfield/InputfieldFieldset.module\nInputfield/InputfieldCKEditor/InputfieldCKEditor.module\nInputfield/InputfieldTextTags/InputfieldTextTags.module\nInputfield/InputfieldHidden.module\nInputfield/InputfieldPageAutocomplete/InputfieldPageAutocomplete.module\nPagePermissions.module\nFieldtype/FieldtypeFile/FieldtypeFile.module\nFieldtype/FieldtypeCache.module\nFieldtype/FieldtypePage.module\nFieldtype/FieldtypeFieldsetOpen.module\nFieldtype/FieldtypeEmail.module\nFieldtype/FieldtypeModule.module\nFieldtype/FieldtypeDecimal.module\nFieldtype/FieldtypeFloat.module\nFieldtype/FieldtypeText.module\nFieldtype/FieldtypeInteger.module\nFieldtype/FieldtypeTextarea.module\nFieldtype/FieldtypePageTitle.module\nFieldtype/FieldtypeCheckbox.module\nFieldtype/FieldtypeRepeater/FieldtypeFieldsetPage.module\nFieldtype/FieldtypeRepeater/FieldtypeRepeater.module\nFieldtype/FieldtypeRepeater/InputfieldRepeater.module\nFieldtype/FieldtypeToggle.module\nFieldtype/FieldtypeSelector.module\nFieldtype/FieldtypeFieldsetTabOpen.module\nFieldtype/FieldtypeOptions/FieldtypeOptions.module\nFieldtype/FieldtypeFieldsetClose.module\nFieldtype/FieldtypePassword.module\nFieldtype/FieldtypePageTable.module\nFieldtype/FieldtypeImage/FieldtypeImage.module\nFieldtype/FieldtypeDatetime.module\nFieldtype/FieldtypeURL.module\nFieldtype/FieldtypeComments/FieldtypeComments.module\nFieldtype/FieldtypeComments/CommentFilterAkismet.module\nFieldtype/FieldtypeComments/InputfieldCommentsAdmin.module\nPages/PagesVersions/PagesVersions.module.php\nAdminTheme/AdminThemeDefault/AdminThemeDefault.module\nAdminTheme/AdminThemeReno/AdminThemeReno.module\nAdminTheme/AdminThemeUikit/AdminThemeUikit.module\nPage/PageFrontEdit/PageFrontEdit.module\nLanguageSupport/FieldtypeTextareaLanguage.module\nLanguageSupport/LanguageSupport.module\nLanguageSupport/LanguageTabs.module\nLanguageSupport/FieldtypeTextLanguage.module\nLanguageSupport/ProcessLanguage.module\nLanguageSupport/LanguageSupportPageNames.module\nLanguageSupport/ProcessLanguageTranslator.module\nLanguageSupport/LanguageSupportFields.module\nLanguageSupport/FieldtypePageTitleLanguage.module', '2025-02-15 20:50:17');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('160', '.Modules.site/modules/', '8192', 'LogsJsonViewer/LogsJsonViewer.module.php\nProcessExportProfile/ProcessExportProfile.module\nPageListCustomChildren/PageListCustomChildren.module.php\nProcessProfileHelper/HelperBackup/HelperBackup.module.php\nProcessProfileHelper/HelperMaintenance/HelperMaintenance.module.php\nProcessProfileHelper/HelperChat/HelperChat.module.php\nProcessProfileHelper/HelperFlatFilesBooster/HelperFlatFilesBooster.module.php\nProcessProfileHelper/HelperOembed/HelperOembed.module.php\nProcessProfileHelper/HelperPwa/HelperPwa.module.php\nProcessProfileHelper/ProcessProfileHelper.module.php\nTextformatterEmoji/TextformatterEmoji.module.php\nLoginRegister/LoginRegister.module\nFileValidatorSvgSanitizer/FileValidatorSvgSanitizer.module.php', '2025-02-15 20:50:17');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('161', '.Modules.info', '8192', '{\"5538\":{\"name\":\"MarkupRSS\",\"title\":\"Markup RSS Feed\",\"version\":105,\"icon\":\"rss-square\",\"created\":1739743786,\"configurable\":3},\"98\":{\"name\":\"MarkupPagerNav\",\"title\":\"Pager (Pagination) Navigation\",\"version\":105,\"created\":1739648997},\"156\":{\"name\":\"MarkupHTMLPurifier\",\"title\":\"HTML Purifier\",\"version\":497,\"created\":1739648997},\"113\":{\"name\":\"MarkupPageArray\",\"title\":\"PageArray Markup\",\"version\":100,\"autoload\":true,\"singular\":true,\"created\":1739648997},\"67\":{\"name\":\"MarkupAdminDataTable\",\"title\":\"Admin Data Table\",\"version\":107,\"created\":1739648997,\"permanent\":true},\"117\":{\"name\":\"JqueryUI\",\"title\":\"jQuery UI\",\"version\":\"1.10.4\",\"singular\":true,\"created\":1739648997,\"permanent\":true},\"103\":{\"name\":\"JqueryTableSorter\",\"title\":\"jQuery Table Sorter Plugin\",\"version\":\"2.31.3\",\"singular\":1,\"created\":1739648997},\"45\":{\"name\":\"JqueryWireTabs\",\"title\":\"jQuery Wire Tabs Plugin\",\"version\":110,\"created\":1739648997,\"configurable\":3,\"permanent\":true},\"151\":{\"name\":\"JqueryMagnific\",\"title\":\"jQuery Magnific Popup\",\"version\":\"1.1.0\",\"singular\":1,\"created\":1739648997},\"116\":{\"name\":\"JqueryCore\",\"title\":\"jQuery Core\",\"version\":\"1.12.4\",\"singular\":true,\"created\":1739648997,\"permanent\":true},\"5561\":{\"name\":\"LazyCron\",\"title\":\"Lazy Cron\",\"version\":104,\"autoload\":true,\"singular\":true,\"created\":1739743846},\"125\":{\"name\":\"SessionLoginThrottle\",\"title\":\"Session Login Throttle\",\"version\":103,\"autoload\":\"function\",\"singular\":true,\"created\":1739648997,\"configurable\":3},\"61\":{\"name\":\"TextformatterEntities\",\"title\":\"HTML Entity Encoder (htmlspecialchars)\",\"version\":100,\"created\":1739648997},\"5605\":{\"name\":\"TextformatterMarkdownExtra\",\"title\":\"Markdown\\/Parsedown Extra\",\"version\":180,\"singular\":1,\"created\":1739745568,\"configurable\":4},\"139\":{\"name\":\"SystemUpdater\",\"title\":\"System Updater\",\"version\":20,\"singular\":true,\"created\":1739648997,\"configurable\":3,\"permanent\":true},\"10\":{\"name\":\"ProcessLogin\",\"title\":\"Login\",\"version\":109,\"permission\":\"page-view\",\"created\":1739648997,\"configurable\":4,\"permanent\":true},\"83\":{\"name\":\"ProcessPageView\",\"title\":\"Page View\",\"version\":106,\"permission\":\"page-view\",\"created\":1739648997,\"permanent\":true},\"7\":{\"name\":\"ProcessPageEdit\",\"title\":\"Page Edit\",\"version\":112,\"icon\":\"edit\",\"permission\":\"page-edit\",\"singular\":1,\"created\":1739648997,\"configurable\":3,\"permanent\":true,\"useNavJSON\":true},\"12\":{\"name\":\"ProcessPageList\",\"title\":\"Page List\",\"version\":124,\"icon\":\"sitemap\",\"permission\":\"page-edit\",\"created\":1739648997,\"configurable\":3,\"permanent\":true,\"useNavJSON\":true},\"109\":{\"name\":\"ProcessPageTrash\",\"title\":\"Page Trash\",\"version\":103,\"singular\":1,\"created\":1739648997,\"permanent\":true},\"129\":{\"name\":\"ProcessPageEditImageSelect\",\"title\":\"Page Edit Image\",\"version\":121,\"permission\":\"page-edit\",\"singular\":1,\"created\":1739648997,\"configurable\":3,\"permanent\":true},\"17\":{\"name\":\"ProcessPageAdd\",\"title\":\"Page Add\",\"version\":109,\"icon\":\"plus-circle\",\"permission\":\"page-edit\",\"created\":1739648997,\"configurable\":3,\"permanent\":true,\"useNavJSON\":true},\"121\":{\"name\":\"ProcessPageEditLink\",\"title\":\"Page Edit Link\",\"version\":112,\"icon\":\"link\",\"permission\":\"page-edit\",\"singular\":1,\"created\":1739648997,\"configurable\":4,\"permanent\":true},\"50\":{\"name\":\"ProcessModule\",\"title\":\"Modules\",\"version\":121,\"permission\":\"module-admin\",\"created\":1739648997,\"permanent\":true,\"useNavJSON\":true,\"nav\":[{\"url\":\"?site#tab_site_modules\",\"label\":\"Site\",\"icon\":\"plug\",\"navJSON\":\"navJSON\\/?site=1\"},{\"url\":\"?core#tab_core_modules\",\"label\":\"Core\",\"icon\":\"plug\",\"navJSON\":\"navJSON\\/?core=1\"},{\"url\":\"?configurable#tab_configurable_modules\",\"label\":\"Configure\",\"icon\":\"gear\",\"navJSON\":\"navJSON\\/?configurable=1\"},{\"url\":\"?install#tab_install_modules\",\"label\":\"Install\",\"icon\":\"sign-in\",\"navJSON\":\"navJSON\\/?install=1\"},{\"url\":\"?new#tab_new_modules\",\"label\":\"New\",\"icon\":\"plus\"},{\"url\":\"?reset=1\",\"label\":\"Refresh\",\"icon\":\"refresh\"}]},\"47\":{\"name\":\"ProcessTemplate\",\"title\":\"Templates\",\"version\":114,\"icon\":\"cubes\",\"permission\":\"template-admin\",\"created\":1739648997,\"configurable\":4,\"permanent\":true,\"useNavJSON\":true},\"14\":{\"name\":\"ProcessPageSort\",\"title\":\"Page Sort and Move\",\"version\":101,\"permission\":\"page-edit\",\"created\":1739648997,\"permanent\":true},\"134\":{\"name\":\"ProcessPageType\",\"title\":\"Page Type\",\"version\":101,\"singular\":1,\"created\":1739648997,\"configurable\":3,\"permanent\":true,\"useNavJSON\":true,\"addFlag\":32},\"76\":{\"name\":\"ProcessList\",\"title\":\"List\",\"version\":101,\"permission\":\"page-view\",\"created\":1739648997,\"permanent\":true},\"136\":{\"name\":\"ProcessPermission\",\"title\":\"Permissions\",\"version\":101,\"icon\":\"gear\",\"permission\":\"permission-admin\",\"singular\":1,\"created\":1739648997,\"configurable\":3,\"permanent\":true,\"useNavJSON\":true},\"5585\":{\"name\":\"ProcessPageClone\",\"title\":\"Page Clone\",\"version\":106,\"permission\":\"page-clone\",\"autoload\":\"template=admin\",\"singular\":true,\"created\":1739743930,\"configurable\":4},\"87\":{\"name\":\"ProcessHome\",\"title\":\"Admin Home\",\"version\":101,\"permission\":\"page-view\",\"created\":1739648997,\"permanent\":true},\"104\":{\"name\":\"ProcessPageSearch\",\"title\":\"Page Search\",\"version\":108,\"permission\":\"page-edit\",\"singular\":1,\"created\":1739648997,\"configurable\":3,\"permanent\":true},\"200\":{\"name\":\"ProcessLogger\",\"title\":\"Logs\",\"version\":2,\"icon\":\"tree\",\"permission\":\"logs-view\",\"singular\":1,\"created\":1739649020,\"useNavJSON\":true},\"150\":{\"name\":\"ProcessPageLister\",\"title\":\"Lister\",\"version\":26,\"icon\":\"search\",\"permission\":\"page-lister\",\"created\":1739648997,\"configurable\":true,\"permanent\":true,\"useNavJSON\":true,\"addFlag\":32},\"66\":{\"name\":\"ProcessUser\",\"title\":\"Users\",\"version\":107,\"icon\":\"group\",\"permission\":\"user-admin\",\"created\":1739648997,\"configurable\":\"ProcessUserConfig.php\",\"permanent\":true,\"useNavJSON\":true},\"5580\":{\"name\":\"ProcessForgotPassword\",\"title\":\"Forgot Password\",\"version\":104,\"permission\":\"page-view\",\"singular\":1,\"created\":1739743918,\"configurable\":4},\"138\":{\"name\":\"ProcessProfile\",\"title\":\"User Profile\",\"version\":105,\"permission\":\"profile-edit\",\"singular\":1,\"created\":1739648997,\"configurable\":3,\"permanent\":true},\"68\":{\"name\":\"ProcessRole\",\"title\":\"Roles\",\"version\":104,\"icon\":\"gears\",\"permission\":\"role-admin\",\"created\":1739648997,\"configurable\":3,\"permanent\":true,\"useNavJSON\":true},\"5575\":{\"name\":\"ProcessCommentsManager\",\"title\":\"Comments\",\"version\":12,\"icon\":\"comments\",\"requiresVersions\":{\"FieldtypeComments\":[\">=\",0]},\"permission\":\"comments-manager\",\"singular\":1,\"created\":1739743904,\"nav\":[{\"url\":\"?go=approved\",\"label\":\"Approved\"},{\"url\":\"?go=pending\",\"label\":\"Pending\"},{\"url\":\"?go=spam\",\"label\":\"Spam\"},{\"url\":\"?go=all\",\"label\":\"All\"}]},\"48\":{\"name\":\"ProcessField\",\"title\":\"Fields\",\"version\":114,\"icon\":\"cube\",\"permission\":\"field-admin\",\"created\":1739648997,\"configurable\":3,\"permanent\":true,\"useNavJSON\":true,\"addFlag\":32},\"5595\":{\"name\":\"ProcessPagesExportImport\",\"title\":\"Pages Export\\/Import\",\"version\":1,\"icon\":\"paper-plane-o\",\"permission\":\"page-edit-export\",\"singular\":1,\"created\":1739743953},\"175\":{\"name\":\"ProcessRecentPages\",\"title\":\"Recent Pages\",\"version\":2,\"icon\":\"clock-o\",\"permission\":\"page-edit-recent\",\"singular\":1,\"created\":1739649018,\"useNavJSON\":true,\"nav\":[{\"url\":\"?edited=1\",\"label\":\"Edited\",\"icon\":\"users\",\"navJSON\":\"navJSON\\/?edited=1\"},{\"url\":\"?added=1\",\"label\":\"Created\",\"icon\":\"users\",\"navJSON\":\"navJSON\\/?added=1\"},{\"url\":\"?edited=1&me=1\",\"label\":\"Edited by me\",\"icon\":\"user\",\"navJSON\":\"navJSON\\/?edited=1&me=1\"},{\"url\":\"?added=1&me=1\",\"label\":\"Created by me\",\"icon\":\"user\",\"navJSON\":\"navJSON\\/?added=1&me=1\"},{\"url\":\"another\\/\",\"label\":\"Add another\",\"icon\":\"plus-circle\",\"navJSON\":\"anotherNavJSON\\/\"}]},\"115\":{\"name\":\"PageRender\",\"title\":\"Page Render\",\"version\":105,\"autoload\":true,\"singular\":true,\"created\":1739648997,\"configurable\":3,\"permanent\":true},\"205\":{\"name\":\"InputfieldIcon\",\"title\":\"Icon\",\"version\":3,\"created\":1739649020},\"43\":{\"name\":\"InputfieldSelectMultiple\",\"title\":\"Select Multiple\",\"version\":101,\"created\":1739648997,\"permanent\":true},\"25\":{\"name\":\"InputfieldAsmSelect\",\"title\":\"asmSelect\",\"version\":203,\"created\":1739648997,\"permanent\":true},\"112\":{\"name\":\"InputfieldPageTitle\",\"title\":\"Page Title\",\"version\":102,\"created\":1739648997,\"permanent\":true},\"41\":{\"name\":\"InputfieldName\",\"title\":\"Name\",\"version\":100,\"created\":1739648997,\"permanent\":true},\"37\":{\"name\":\"InputfieldCheckbox\",\"title\":\"Checkbox\",\"version\":106,\"created\":1739648997,\"permanent\":true},\"122\":{\"name\":\"InputfieldPassword\",\"title\":\"Password\",\"version\":102,\"created\":1739648997,\"permanent\":true},\"39\":{\"name\":\"InputfieldRadios\",\"title\":\"Radio Buttons\",\"version\":106,\"created\":1739648997,\"permanent\":true},\"79\":{\"name\":\"InputfieldMarkup\",\"title\":\"Markup\",\"version\":102,\"created\":1739648997,\"permanent\":true},\"108\":{\"name\":\"InputfieldURL\",\"title\":\"URL\",\"version\":103,\"created\":1739648997},\"86\":{\"name\":\"InputfieldPageName\",\"title\":\"Page Name\",\"version\":106,\"created\":1739648997,\"configurable\":3,\"permanent\":true},\"56\":{\"name\":\"InputfieldImage\",\"title\":\"Images\",\"version\":129,\"created\":1739648997,\"permanent\":true},\"35\":{\"name\":\"InputfieldTextarea\",\"title\":\"Textarea\",\"version\":103,\"created\":1739648997,\"permanent\":true},\"137\":{\"name\":\"InputfieldPageListSelectMultiple\",\"title\":\"Page List Select Multiple\",\"version\":103,\"created\":1739648997,\"permanent\":true},\"15\":{\"name\":\"InputfieldPageListSelect\",\"title\":\"Page List Select\",\"version\":101,\"created\":1739648997,\"permanent\":true},\"149\":{\"name\":\"InputfieldSelector\",\"title\":\"Selector\",\"version\":28,\"autoload\":\"template=admin\",\"created\":1739648997,\"configurable\":3,\"addFlag\":32},\"34\":{\"name\":\"InputfieldText\",\"title\":\"Text\",\"version\":106,\"created\":1739648997,\"permanent\":true},\"36\":{\"name\":\"InputfieldSelect\",\"title\":\"Select\",\"version\":103,\"created\":1739648997,\"permanent\":true},\"32\":{\"name\":\"InputfieldSubmit\",\"title\":\"Submit\",\"version\":103,\"created\":1739648997,\"permanent\":true},\"90\":{\"name\":\"InputfieldFloat\",\"title\":\"Float\",\"version\":105,\"created\":1739648997,\"permanent\":true},\"80\":{\"name\":\"InputfieldEmail\",\"title\":\"Email\",\"version\":102,\"created\":1739648997},\"94\":{\"name\":\"InputfieldDatetime\",\"title\":\"Datetime\",\"version\":108,\"created\":1739648997,\"permanent\":true},\"131\":{\"name\":\"InputfieldButton\",\"title\":\"Button\",\"version\":100,\"created\":1739648997,\"permanent\":true},\"30\":{\"name\":\"InputfieldForm\",\"title\":\"Form\",\"version\":107,\"created\":1739648997,\"permanent\":true},\"60\":{\"name\":\"InputfieldPage\",\"title\":\"Page\",\"version\":109,\"created\":1739648997,\"configurable\":3,\"permanent\":true},\"5567\":{\"name\":\"InputfieldPageTable\",\"title\":\"ProFields: Page Table\",\"version\":14,\"requiresVersions\":{\"FieldtypePageTable\":[\">=\",0]},\"created\":1739743860},\"85\":{\"name\":\"InputfieldInteger\",\"title\":\"Integer\",\"version\":105,\"created\":1739648997,\"permanent\":true},\"38\":{\"name\":\"InputfieldCheckboxes\",\"title\":\"Checkboxes\",\"version\":108,\"created\":1739648997,\"permanent\":true},\"155\":{\"name\":\"InputfieldTinyMCE\",\"title\":\"TinyMCE\",\"version\":618,\"icon\":\"keyboard-o\",\"requiresVersions\":{\"ProcessWire\":[\">=\",\"3.0.200\"],\"MarkupHTMLPurifier\":[\">=\",0]},\"created\":1739648997,\"configurable\":4},\"5569\":{\"name\":\"InputfieldToggle\",\"title\":\"Toggle\",\"version\":1,\"created\":1739743880},\"55\":{\"name\":\"InputfieldFile\",\"title\":\"Files\",\"version\":129,\"created\":1739648997,\"permanent\":true},\"78\":{\"name\":\"InputfieldFieldset\",\"title\":\"Fieldset\",\"version\":101,\"created\":1739648997,\"permanent\":true},\"5556\":{\"name\":\"InputfieldTextTags\",\"title\":\"Text Tags\",\"version\":7,\"icon\":\"tags\",\"created\":1739743832},\"40\":{\"name\":\"InputfieldHidden\",\"title\":\"Hidden\",\"version\":101,\"created\":1739648997,\"permanent\":true},\"5600\":{\"name\":\"InputfieldPageAutocomplete\",\"title\":\"Page Auto Complete\",\"version\":113,\"created\":1739743992},\"114\":{\"name\":\"PagePermissions\",\"title\":\"Page Permissions\",\"version\":105,\"autoload\":true,\"singular\":true,\"created\":1739648997,\"permanent\":true},\"6\":{\"name\":\"FieldtypeFile\",\"title\":\"Files\",\"version\":107,\"created\":1739648997,\"configurable\":4,\"permanent\":true},\"4\":{\"name\":\"FieldtypePage\",\"title\":\"Page Reference\",\"version\":107,\"created\":1739648997,\"configurable\":3,\"permanent\":true},\"105\":{\"name\":\"FieldtypeFieldsetOpen\",\"title\":\"Fieldset (Open)\",\"version\":101,\"singular\":true,\"created\":1739648997,\"permanent\":true},\"29\":{\"name\":\"FieldtypeEmail\",\"title\":\"E-Mail\",\"version\":101,\"created\":1739648997},\"27\":{\"name\":\"FieldtypeModule\",\"title\":\"Module Reference\",\"version\":102,\"created\":1739648997,\"permanent\":true},\"89\":{\"name\":\"FieldtypeFloat\",\"title\":\"Float\",\"version\":108,\"singular\":1,\"created\":1739648997,\"permanent\":true},\"3\":{\"name\":\"FieldtypeText\",\"title\":\"Text\",\"version\":102,\"created\":1739648997,\"permanent\":true},\"84\":{\"name\":\"FieldtypeInteger\",\"title\":\"Integer\",\"version\":102,\"created\":1739648997,\"permanent\":true},\"1\":{\"name\":\"FieldtypeTextarea\",\"title\":\"Textarea\",\"version\":107,\"created\":1739648997,\"permanent\":true},\"111\":{\"name\":\"FieldtypePageTitle\",\"title\":\"Page Title\",\"version\":100,\"singular\":true,\"created\":1739648997,\"permanent\":true},\"97\":{\"name\":\"FieldtypeCheckbox\",\"title\":\"Checkbox\",\"version\":101,\"singular\":true,\"created\":1739648997,\"permanent\":true},\"5543\":{\"name\":\"FieldtypeRepeater\",\"title\":\"Repeater\",\"version\":113,\"installs\":[\"InputfieldRepeater\"],\"autoload\":true,\"singular\":true,\"created\":1739743798,\"configurable\":3},\"5545\":{\"name\":\"FieldtypeFieldsetPage\",\"title\":\"Fieldset (Page)\",\"version\":1,\"requiresVersions\":{\"FieldtypeRepeater\":[\">=\",0]},\"autoload\":true,\"singular\":true,\"created\":1739743798,\"configurable\":3},\"5544\":{\"name\":\"InputfieldRepeater\",\"title\":\"Repeater\",\"version\":111,\"requiresVersions\":{\"FieldtypeRepeater\":[\">=\",0]},\"created\":1739743798},\"5570\":{\"name\":\"FieldtypeToggle\",\"title\":\"Toggle (Yes\\/No)\",\"version\":1,\"requiresVersions\":{\"InputfieldToggle\":[\">=\",0]},\"singular\":1,\"created\":1739743880},\"107\":{\"name\":\"FieldtypeFieldsetTabOpen\",\"title\":\"Fieldset in Tab (Open)\",\"version\":100,\"singular\":1,\"created\":1739648997,\"permanent\":true},\"5590\":{\"name\":\"FieldtypeOptions\",\"title\":\"Select Options\",\"version\":2,\"singular\":true,\"created\":1739743938},\"106\":{\"name\":\"FieldtypeFieldsetClose\",\"title\":\"Fieldset (Close)\",\"version\":100,\"singular\":true,\"created\":1739648997,\"permanent\":true},\"133\":{\"name\":\"FieldtypePassword\",\"title\":\"Password\",\"version\":101,\"singular\":true,\"created\":1739648997,\"permanent\":true},\"5566\":{\"name\":\"FieldtypePageTable\",\"title\":\"ProFields: Page Table\",\"version\":8,\"installs\":[\"InputfieldPageTable\"],\"autoload\":true,\"singular\":true,\"created\":1739743860},\"57\":{\"name\":\"FieldtypeImage\",\"title\":\"Images\",\"version\":102,\"created\":1739648997,\"configurable\":4,\"permanent\":true},\"28\":{\"name\":\"FieldtypeDatetime\",\"title\":\"Datetime\",\"version\":105,\"created\":1739648997},\"135\":{\"name\":\"FieldtypeURL\",\"title\":\"URL\",\"version\":101,\"singular\":true,\"created\":1739648997,\"permanent\":true},\"5550\":{\"name\":\"FieldtypeComments\",\"title\":\"Comments\",\"version\":110,\"installs\":[\"InputfieldCommentsAdmin\"],\"singular\":true,\"created\":1739743812},\"5551\":{\"name\":\"InputfieldCommentsAdmin\",\"title\":\"Comments Admin\",\"version\":104,\"requiresVersions\":{\"FieldtypeComments\":[\">=\",0]},\"created\":1739743812},\"148\":{\"name\":\"AdminThemeDefault\",\"title\":\"Default\",\"version\":14,\"autoload\":\"template=admin\",\"created\":1739648997,\"configurable\":19},\"187\":{\"name\":\"AdminThemeUikit\",\"title\":\"Uikit\",\"version\":34,\"autoload\":\"template=admin\",\"created\":1739649018,\"configurable\":4},\"5653\":{\"name\":\"LogsJsonViewer\",\"title\":\"Logs JSON Viewer\",\"version\":\"0.1.1\",\"icon\":\"indent\",\"requiresVersions\":{\"ProcessWire\":[\">=\",\"3.0.0\"],\"PHP\":[\">=\",\"5.4.0\"]},\"autoload\":\"process=ProcessLogger\",\"created\":1740253233,\"configurable\":4},\"5689\":{\"name\":\"PageListCustomChildren\",\"title\":\"Page List Custom Children\",\"version\":2,\"icon\":\"sitemap\",\"requiresVersions\":{\"ProcessWire\":[\">=\",\"3.0.200\"]},\"autoload\":\"template=admin\",\"created\":1740772664,\"configurable\":4},\"5616\":{\"name\":\"ProcessProfileHelper\",\"title\":\"Profile Helper Module, based on ProcessHello module\",\"version\":1,\"icon\":\"thumbs-up\",\"requiresVersions\":{\"ProcessWire\":[\">=\",\"3.0.164\"]},\"installs\":[\"HelperBackup\",\"HelperOembed\",\"HelperMaintenance\",\"HelperFlatFilesBooster\"],\"permission\":\"profilehelper\",\"autoload\":true,\"singular\":true,\"created\":1740139224,\"configurable\":4,\"nav\":[{\"url\":\"manage-logs\\/\",\"label\":\"Manage Logs\",\"icon\":\"crosshairs\"},{\"url\":\"\",\"label\":\"Hello\",\"icon\":\"smile-o\"},{\"url\":\"something\\/\",\"label\":\"Something\",\"icon\":\"beer\"},{\"url\":\"something-else\\/\",\"label\":\"Something Else\",\"icon\":\"glass\"},{\"url\":\"form\\/\",\"label\":\"Simple form\",\"icon\":\"building\"}]},\"5617\":{\"name\":\"HelperBackup\",\"title\":\"Helper site Backup\",\"version\":\"1\",\"icon\":\"database\",\"requiresVersions\":{\"ProcessProfileHelper\":[\">=\",0],\"LazyCron\":[\">=\",0]},\"autoload\":true,\"singular\":true,\"created\":1740139224,\"configurable\":4},\"5619\":{\"name\":\"HelperMaintenance\",\"title\":\"Helper Maintenance\",\"version\":\"1\",\"icon\":\"lock\",\"requiresVersions\":{\"ProcessProfileHelper\":[\">=\",0]},\"autoload\":true,\"singular\":true,\"created\":1740139224,\"configurable\":4},\"5795\":{\"name\":\"HelperChat\",\"title\":\"Helper Chat\",\"version\":\"1\",\"icon\":\"smile-o\",\"requiresVersions\":{\"ProcessProfileHelper\":[\">=\",0]},\"autoload\":true,\"singular\":true,\"created\":1741258611,\"configurable\":4},\"5618\":{\"name\":\"HelperOembed\",\"title\":\"Helper Oembed\",\"version\":\"1\",\"icon\":\"file-code-o\",\"requiresVersions\":{\"ProcessProfileHelper\":[\">=\",0]},\"autoload\":true,\"singular\":true,\"created\":1740139224,\"configurable\":4},\"5964\":{\"name\":\"TextformatterEmoji\",\"title\":\"Emoji\",\"version\":1,\"icon\":\"smile-o\",\"requiresVersions\":{\"ProcessWire\":[\">=\",\"3.0.164\"]},\"singular\":1,\"created\":1742133197,\"configurable\":4},\"5975\":{\"name\":\"LoginRegister\",\"title\":\"Login\\/Register\",\"version\":2,\"icon\":\"user-plus\",\"created\":1742157276,\"configurable\":4},\"5533\":{\"name\":\"FileValidatorSvgSanitizer\",\"title\":\"SVG File Sanitizer\\/Validator\",\"version\":5,\"requiresVersions\":{\"ProcessWire\":[\">=\",\"3.0.148\"]},\"created\":1739743620,\"configurable\":\"FileValidatorSvgSanitizer.config.php\",\"validates\":[\"svg\"]},\"6038\":{\"name\":\"ProcessExportProfile\",\"title\":\"Export Site Profile\",\"version\":501,\"icon\":\"truck\",\"requiresVersions\":{\"ProcessWire\":[\">=\",\"3.0.200\"]},\"singular\":true}}', '2025-02-15 20:50:18');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('162', '.ModulesVerbose.info', '8192', '{\"5538\":{\"summary\":\"Renders an RSS feed. Given a PageArray, renders an RSS feed of them.\",\"core\":true,\"versionStr\":\"1.0.5\"},\"98\":{\"summary\":\"Generates markup for pagination navigation\",\"core\":true,\"versionStr\":\"1.0.5\"},\"156\":{\"summary\":\"Front-end to the HTML Purifier library.\",\"core\":true,\"versionStr\":\"4.9.7\"},\"113\":{\"summary\":\"Adds renderPager() method to all PaginatedArray types, for easy pagination output. Plus a render() method to PageArray instances.\",\"core\":true,\"versionStr\":\"1.0.0\"},\"67\":{\"summary\":\"Generates markup for data tables used by ProcessWire admin\",\"core\":true,\"versionStr\":\"1.0.7\"},\"117\":{\"summary\":\"jQuery UI as required by ProcessWire and plugins\",\"href\":\"https:\\/\\/ui.jquery.com\",\"core\":true,\"versionStr\":\"1.10.4\"},\"103\":{\"summary\":\"Provides a jQuery plugin for sorting tables.\",\"href\":\"https:\\/\\/mottie.github.io\\/tablesorter\\/\",\"core\":true,\"versionStr\":\"2.31.3\"},\"45\":{\"summary\":\"Provides a jQuery plugin for generating tabs in ProcessWire.\",\"core\":true,\"versionStr\":\"1.1.0\"},\"151\":{\"summary\":\"Provides lightbox capability for image galleries. Replacement for FancyBox. Uses Magnific Popup by @dimsemenov.\",\"href\":\"https:\\/\\/github.com\\/dimsemenov\\/Magnific-Popup\\/\",\"core\":true,\"versionStr\":\"1.1.0\"},\"116\":{\"summary\":\"jQuery Core as required by ProcessWire Admin and plugins\",\"href\":\"https:\\/\\/jquery.com\",\"core\":true,\"versionStr\":\"1.12.4\"},\"5561\":{\"summary\":\"Provides hooks that are automatically executed at various intervals. It is called \'lazy\' because it\'s triggered by a pageview, so the interval is guaranteed to be at least the time requested, rather than exactly the time requested. This is fine for most cases, but you can make it not lazy by connecting this to a real CRON job. See the module file for details. \",\"href\":\"https:\\/\\/processwire.com\\/api\\/modules\\/lazy-cron\\/\",\"core\":true,\"versionStr\":\"1.0.4\"},\"125\":{\"summary\":\"Throttles login attempts to help prevent dictionary attacks.\",\"core\":true,\"versionStr\":\"1.0.3\"},\"61\":{\"summary\":\"Entity encode ampersands, quotes (single and double) and greater-than\\/less-than signs using htmlspecialchars(str, ENT_QUOTES). It is recommended that you use this on all text\\/textarea fields except those using a rich text editor or a markup language like Markdown.\",\"core\":true,\"versionStr\":\"1.0.0\"},\"5605\":{\"summary\":\"Markdown\\/Parsedown extra lightweight markup language by Emanuil Rusev. Based on Markdown by John Gruber.\",\"core\":true,\"versionStr\":\"1.8.0\"},\"139\":{\"summary\":\"Manages system versions and upgrades.\",\"core\":true,\"versionStr\":\"0.2.0\"},\"10\":{\"summary\":\"Login to ProcessWire\",\"core\":true,\"versionStr\":\"1.0.9\"},\"83\":{\"summary\":\"All page views are routed through this Process\",\"core\":true,\"versionStr\":\"1.0.6\"},\"7\":{\"summary\":\"Edit a Page\",\"core\":true,\"versionStr\":\"1.1.2\"},\"12\":{\"summary\":\"List pages in a hierarchical tree structure\",\"core\":true,\"versionStr\":\"1.2.4\"},\"109\":{\"summary\":\"Handles emptying of Page trash\",\"core\":true,\"versionStr\":\"1.0.3\"},\"129\":{\"summary\":\"Provides image manipulation functions for image fields and rich text editors.\",\"core\":true,\"versionStr\":\"1.2.1\"},\"17\":{\"summary\":\"Add a new page\",\"core\":true,\"versionStr\":\"1.0.9\"},\"121\":{\"summary\":\"Provides a link capability as used by some Fieldtype modules (like rich text editors).\",\"core\":true,\"versionStr\":\"1.1.2\"},\"50\":{\"summary\":\"List, edit or install\\/uninstall modules\",\"core\":true,\"versionStr\":\"1.2.1\"},\"47\":{\"summary\":\"List and edit the templates that control page output\",\"core\":true,\"versionStr\":\"1.1.4\",\"searchable\":\"templates\"},\"14\":{\"summary\":\"Handles page sorting and moving for PageList\",\"core\":true,\"versionStr\":\"1.0.1\"},\"134\":{\"summary\":\"List, Edit and Add pages of a specific type\",\"core\":true,\"versionStr\":\"1.0.1\"},\"76\":{\"summary\":\"Lists the Process assigned to each child page of the current\",\"core\":true,\"versionStr\":\"1.0.1\"},\"136\":{\"summary\":\"Manage system permissions\",\"core\":true,\"versionStr\":\"1.0.1\"},\"5585\":{\"summary\":\"Provides ability to clone\\/copy\\/duplicate pages in the admin. Adds a &quot;copy&quot; option to all applicable pages in the PageList.\",\"core\":true,\"versionStr\":\"1.0.6\",\"permissions\":{\"page-clone\":\"Clone a page\",\"page-clone-tree\":\"Clone a tree of pages\"},\"page\":{\"name\":\"clone\",\"title\":\"Clone\",\"parent\":\"page\",\"status\":1024}},\"87\":{\"summary\":\"Acts as a placeholder Process for the admin root. Ensures proper flow control after login.\",\"core\":true,\"versionStr\":\"1.0.1\"},\"104\":{\"summary\":\"Provides a page search engine for admin use.\",\"core\":true,\"versionStr\":\"1.0.8\"},\"200\":{\"summary\":\"View and manage system logs.\",\"author\":\"Ryan Cramer\",\"core\":true,\"versionStr\":\"0.0.2\",\"permissions\":{\"logs-view\":\"Can view system logs\",\"logs-edit\":\"Can manage system logs\"},\"page\":{\"name\":\"logs\",\"parent\":\"setup\",\"title\":\"Logs\"}},\"150\":{\"summary\":\"Admin tool for finding and listing pages by any property.\",\"author\":\"Ryan Cramer\",\"core\":true,\"versionStr\":\"0.2.6\",\"permissions\":{\"page-lister\":\"Use Page Lister\"}},\"66\":{\"summary\":\"Manage system users\",\"core\":true,\"versionStr\":\"1.0.7\",\"searchable\":\"users\"},\"5580\":{\"summary\":\"Provides password reset\\/email capability for the Login process.\",\"core\":true,\"versionStr\":\"1.0.4\"},\"138\":{\"summary\":\"Enables user to change their password, email address and other settings that you define.\",\"core\":true,\"versionStr\":\"1.0.5\"},\"68\":{\"summary\":\"Manage user roles and what permissions are attached\",\"core\":true,\"versionStr\":\"1.0.4\"},\"5575\":{\"summary\":\"Manage comments in your site outside of the page editor.\",\"author\":\"Ryan Cramer\",\"core\":true,\"versionStr\":\"0.1.2\",\"permissions\":{\"comments-manager\":\"Use the comments manager\"},\"searchable\":\"comments\",\"page\":{\"name\":\"comments\",\"parent\":\"setup\",\"title\":\"Comments\"}},\"48\":{\"summary\":\"Edit individual fields that hold page data\",\"core\":true,\"versionStr\":\"1.1.4\",\"searchable\":\"fields\"},\"5595\":{\"summary\":\"Enables exporting and importing of pages. Development version, not yet recommended for production use.\",\"author\":\"Ryan Cramer\",\"core\":true,\"versionStr\":\"0.0.1\",\"page\":{\"name\":\"export-import\",\"parent\":\"page\",\"title\":\"Export\\/Import\"}},\"175\":{\"summary\":\"Shows a list of recently edited pages in your admin.\",\"author\":\"Ryan Cramer\",\"href\":\"http:\\/\\/modules.processwire.com\\/\",\"core\":true,\"versionStr\":\"0.0.2\",\"permissions\":{\"page-edit-recent\":\"Can see recently edited pages\"},\"page\":{\"name\":\"recent-pages\",\"parent\":\"page\",\"title\":\"Recent\"}},\"115\":{\"summary\":\"Adds a render method to Page and caches page output.\",\"core\":true,\"versionStr\":\"1.0.5\"},\"205\":{\"summary\":\"Select an icon\",\"core\":true,\"versionStr\":\"0.0.3\"},\"43\":{\"summary\":\"Select multiple items from a list\",\"core\":true,\"versionStr\":\"1.0.1\"},\"25\":{\"summary\":\"Multiple selection, progressive enhancement to select multiple\",\"core\":true,\"versionStr\":\"2.0.3\"},\"112\":{\"summary\":\"Handles input of Page Title and auto-generation of Page Name (when name is blank)\",\"core\":true,\"versionStr\":\"1.0.2\"},\"41\":{\"summary\":\"Text input validated as a ProcessWire name field\",\"core\":true,\"versionStr\":\"1.0.0\"},\"37\":{\"summary\":\"Single checkbox toggle\",\"core\":true,\"versionStr\":\"1.0.6\"},\"122\":{\"summary\":\"Password input with confirmation field that doesn&#039;t ever echo the input back.\",\"core\":true,\"versionStr\":\"1.0.2\"},\"39\":{\"summary\":\"Radio buttons for selection of a single item\",\"core\":true,\"versionStr\":\"1.0.6\"},\"79\":{\"summary\":\"Contains any other markup and optionally child Inputfields\",\"core\":true,\"versionStr\":\"1.0.2\"},\"108\":{\"summary\":\"URL in valid format\",\"core\":true,\"versionStr\":\"1.0.3\"},\"86\":{\"summary\":\"Text input validated as a ProcessWire Page name field\",\"core\":true,\"versionStr\":\"1.0.6\"},\"56\":{\"summary\":\"One or more image uploads (sortable)\",\"core\":true,\"versionStr\":\"1.2.9\"},\"35\":{\"summary\":\"Multiple lines of text\",\"core\":true,\"versionStr\":\"1.0.3\"},\"137\":{\"summary\":\"Selection of multiple pages from a ProcessWire page tree list\",\"core\":true,\"versionStr\":\"1.0.3\"},\"15\":{\"summary\":\"Selection of a single page from a ProcessWire page tree list\",\"core\":true,\"versionStr\":\"1.0.1\"},\"149\":{\"summary\":\"Build a page finding selector visually.\",\"author\":\"Avoine + ProcessWire\",\"core\":true,\"versionStr\":\"0.2.8\"},\"34\":{\"summary\":\"Single line of text\",\"core\":true,\"versionStr\":\"1.0.6\"},\"36\":{\"summary\":\"Selection of a single value from a select pulldown\",\"core\":true,\"versionStr\":\"1.0.3\"},\"32\":{\"summary\":\"Form submit button\",\"core\":true,\"versionStr\":\"1.0.3\"},\"90\":{\"summary\":\"Floating point number with precision\",\"core\":true,\"versionStr\":\"1.0.5\"},\"80\":{\"summary\":\"E-Mail address in valid format\",\"core\":true,\"versionStr\":\"1.0.2\"},\"94\":{\"summary\":\"Inputfield that accepts date and optionally time\",\"core\":true,\"versionStr\":\"1.0.8\"},\"131\":{\"summary\":\"Form button element that you can optionally pass an href attribute to.\",\"core\":true,\"versionStr\":\"1.0.0\"},\"30\":{\"summary\":\"Contains one or more fields in a form\",\"core\":true,\"versionStr\":\"1.0.7\"},\"60\":{\"summary\":\"Select one or more pages\",\"core\":true,\"versionStr\":\"1.0.9\"},\"5567\":{\"summary\":\"Inputfield to accompany FieldtypePageTable\",\"core\":true,\"versionStr\":\"0.1.4\"},\"85\":{\"summary\":\"Integer (positive or negative)\",\"core\":true,\"versionStr\":\"1.0.5\"},\"38\":{\"summary\":\"Multiple checkbox toggles\",\"core\":true,\"versionStr\":\"1.0.8\"},\"155\":{\"summary\":\"TinyMCE rich text editor version 6.8.2.\",\"core\":true,\"versionStr\":\"6.1.8\"},\"5569\":{\"summary\":\"A toggle providing similar input capability to a checkbox but much more configurable.\",\"core\":true,\"versionStr\":\"0.0.1\"},\"55\":{\"summary\":\"One or more file uploads (sortable)\",\"core\":true,\"versionStr\":\"1.2.9\"},\"78\":{\"summary\":\"Groups one or more fields together in a container\",\"core\":true,\"versionStr\":\"1.0.1\"},\"5556\":{\"summary\":\"Enables input of user entered tags or selection of predefined tags.\",\"core\":true,\"versionStr\":\"0.0.7\"},\"40\":{\"summary\":\"Hidden value in a form\",\"core\":true,\"versionStr\":\"1.0.1\"},\"5600\":{\"summary\":\"Multiple Page selection using auto completion and sorting capability. Intended for use as an input field for Page reference fields.\",\"core\":true,\"versionStr\":\"1.1.3\"},\"114\":{\"summary\":\"Adds various permission methods to Page objects that are used by Process modules.\",\"core\":true,\"versionStr\":\"1.0.5\"},\"6\":{\"summary\":\"Field that stores one or more files\",\"core\":true,\"versionStr\":\"1.0.7\"},\"4\":{\"summary\":\"Field that stores one or more references to ProcessWire pages\",\"core\":true,\"versionStr\":\"1.0.7\"},\"105\":{\"summary\":\"Open a fieldset to group fields. Should be followed by a Fieldset (Close) after one or more fields.\",\"core\":true,\"versionStr\":\"1.0.1\"},\"29\":{\"summary\":\"Field that stores an e-mail address\",\"core\":true,\"versionStr\":\"1.0.1\"},\"27\":{\"summary\":\"Field that stores a reference to another module\",\"core\":true,\"versionStr\":\"1.0.2\"},\"89\":{\"summary\":\"Field that stores a floating point number\",\"core\":true,\"versionStr\":\"1.0.8\"},\"3\":{\"summary\":\"Field that stores a single line of text\",\"core\":true,\"versionStr\":\"1.0.2\"},\"84\":{\"summary\":\"Field that stores an integer\",\"core\":true,\"versionStr\":\"1.0.2\"},\"1\":{\"summary\":\"Field that stores multiple lines of text\",\"core\":true,\"versionStr\":\"1.0.7\"},\"111\":{\"summary\":\"Field that stores a page title\",\"core\":true,\"versionStr\":\"1.0.0\"},\"97\":{\"summary\":\"This Fieldtype stores an ON\\/OFF toggle via a single checkbox. The ON value is 1 and OFF value is 0.\",\"core\":true,\"versionStr\":\"1.0.1\"},\"5543\":{\"summary\":\"Maintains a collection of fields that are repeated for any number of times.\",\"core\":true,\"versionStr\":\"1.1.3\"},\"5545\":{\"summary\":\"Fieldset with fields isolated to separate namespace (page), enabling re-use of fields.\",\"core\":true,\"versionStr\":\"0.0.1\"},\"5544\":{\"summary\":\"Repeats fields from another template. Provides the input for FieldtypeRepeater.\",\"core\":true,\"versionStr\":\"1.1.1\"},\"5570\":{\"summary\":\"Configurable yes\\/no, on\\/off toggle alternative to a checkbox, plus optional \\u201cother\\u201d option.\",\"core\":true,\"versionStr\":\"0.0.1\"},\"107\":{\"summary\":\"Open a fieldset to group fields. Same as Fieldset (Open) except that it displays in a tab instead.\",\"core\":true,\"versionStr\":\"1.0.0\"},\"5590\":{\"summary\":\"Field that stores single and multi select options.\",\"core\":true,\"versionStr\":\"0.0.2\"},\"106\":{\"summary\":\"Close a fieldset opened by FieldsetOpen. \",\"core\":true,\"versionStr\":\"1.0.0\"},\"133\":{\"summary\":\"Field that stores a hashed and salted password\",\"core\":true,\"versionStr\":\"1.0.1\"},\"5566\":{\"summary\":\"A fieldtype containing a group of editable pages.\",\"core\":true,\"versionStr\":\"0.0.8\"},\"57\":{\"summary\":\"Field that stores one or more GIF, JPG, or PNG images\",\"core\":true,\"versionStr\":\"1.0.2\"},\"28\":{\"summary\":\"Field that stores a date and optionally time\",\"core\":true,\"versionStr\":\"1.0.5\"},\"135\":{\"summary\":\"Field that stores a URL\",\"core\":true,\"versionStr\":\"1.0.1\"},\"5550\":{\"summary\":\"Field that stores user posted comments for a single Page\",\"core\":true,\"versionStr\":\"1.1.0\"},\"5551\":{\"summary\":\"Provides an administrative interface for working with comments\",\"core\":true,\"versionStr\":\"1.0.4\"},\"148\":{\"summary\":\"Minimal admin theme that supports all ProcessWire features.\",\"core\":true,\"versionStr\":\"0.1.4\"},\"187\":{\"summary\":\"Uikit v3 admin theme\",\"core\":true,\"versionStr\":\"0.3.4\"},\"5653\":{\"summary\":\"Formats JSON data in ProcessLogger for improved readability.\",\"author\":\"Robin Sallis\",\"href\":\"https:\\/\\/github.com\\/Toutouwai\\/LogsJsonViewer\",\"versionStr\":\"0.1.1\"},\"5689\":{\"summary\":\"Makes children\\/subpages in PageList customizable so they can appear under multiple parents.\",\"author\":\"Ryan Cramer\",\"versionStr\":\"0.0.2\"},\"5616\":{\"summary\":\"A starting point module skeleton from which to build your own Process module.\",\"author\":\"rafaoski\",\"versionStr\":\"0.0.1\",\"permissions\":{\"profilehelper\":\"Run the profilehelper module\"},\"page\":{\"name\":\"profile-helper\",\"parent\":\"setup\",\"title\":\"Profile Helper\"}},\"5617\":{\"summary\":\"Creates a copy of your site.\",\"author\":\"rafaoski\",\"versionStr\":\"0.0.1\",\"page\":{\"name\":\"helper-backup\",\"parent\":\"setup\",\"title\":\"Helper Backup\"}},\"5619\":{\"summary\":\"Maintenance mode.\",\"author\":\"rafaoski\",\"versionStr\":\"0.0.1\"},\"5795\":{\"summary\":\"Simple chat based on ChatGpt.\",\"author\":\"rafaoski\",\"versionStr\":\"0.0.1\"},\"5618\":{\"summary\":\"This module uses the Embera Oembed library which supports +150 sites, such as Youtube, Twitter, Livestream, Dailymotion, Instagram, Vimeo and many many more.\",\"author\":\"rafaoski\",\"versionStr\":\"0.0.1\",\"page\":{\"name\":\"helper-oembed\",\"parent\":\"setup\",\"title\":\"Helper Oembed\"}},\"5964\":{\"summary\":\"Converts 800+ emojis shortcodes in text to native browser UTF-8 emoji.\",\"versionStr\":\"0.0.1\"},\"5975\":{\"summary\":\"Login or register for an account in ProcessWire\",\"versionStr\":\"0.0.2\"},\"5533\":{\"summary\":\"Validates and\\/or sanitizes uploaded SVG files.\",\"author\":\"Adrian and Ryan\",\"versionStr\":\"0.0.5\"},\"6038\":{\"summary\":\"Create a site profile that can be used for a fresh install of ProcessWire.\",\"versionStr\":\"5.0.1\",\"page\":{\"name\":\"export-site-profile\",\"parent\":\"setup\"}}}', '2025-02-15 20:50:18');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('163', '.ModulesUninstalled.info', '8192', '{\"MarkupCache\":{\"name\":\"MarkupCache\",\"title\":\"Markup Cache\",\"version\":101,\"versionStr\":\"1.0.1\",\"summary\":\"A simple way to cache segments of markup in your templates. \",\"href\":\"https:\\/\\/processwire.com\\/api\\/modules\\/markupcache\\/\",\"autoload\":true,\"singular\":true,\"created\":1742133640,\"installed\":false,\"configurable\":3,\"core\":true},\"MarkupPageFields\":{\"name\":\"MarkupPageFields\",\"title\":\"Markup Page Fields\",\"version\":100,\"versionStr\":\"1.0.0\",\"summary\":\"Adds $page->renderFields() and $page->images->render() methods that return basic markup for output during development and debugging.\",\"autoload\":true,\"singular\":true,\"created\":1742133640,\"installed\":false,\"core\":true,\"permanent\":true},\"SessionHandlerDB\":{\"name\":\"SessionHandlerDB\",\"title\":\"Session Handler Database\",\"version\":6,\"versionStr\":\"0.0.6\",\"summary\":\"Installing this module makes ProcessWire store sessions in the database rather than the file system. Note that this module will log you out after install or uninstall.\",\"installs\":[\"ProcessSessionDB\"],\"created\":1742133640,\"installed\":false,\"configurable\":3,\"core\":true},\"ProcessSessionDB\":{\"name\":\"ProcessSessionDB\",\"title\":\"Sessions\",\"version\":5,\"versionStr\":\"0.0.5\",\"summary\":\"Enables you to browse active database sessions.\",\"icon\":\"dashboard\",\"requiresVersions\":{\"SessionHandlerDB\":[\">=\",0]},\"created\":1742133640,\"installed\":false,\"core\":true,\"page\":{\"name\":\"sessions-db\",\"parent\":\"access\",\"title\":\"Sessions\"}},\"TextformatterNewlineUL\":{\"name\":\"TextformatterNewlineUL\",\"title\":\"Newlines to Unordered List\",\"version\":100,\"versionStr\":\"1.0.0\",\"summary\":\"Converts newlines to <li> list items and surrounds in an <ul> unordered list. \",\"created\":1742133640,\"installed\":false,\"core\":true},\"TextformatterStripTags\":{\"name\":\"TextformatterStripTags\",\"title\":\"Strip Markup Tags\",\"version\":100,\"versionStr\":\"1.0.0\",\"summary\":\"Strips HTML\\/XHTML Markup Tags\",\"created\":1742133640,\"installed\":false,\"configurable\":3,\"core\":true},\"TextformatterNewlineBR\":{\"name\":\"TextformatterNewlineBR\",\"title\":\"Newlines to XHTML Line Breaks\",\"version\":100,\"versionStr\":\"1.0.0\",\"summary\":\"Converts newlines to XHTML line break <br \\/> tags. \",\"created\":1742133640,\"installed\":false,\"core\":true},\"TextformatterSmartypants\":{\"name\":\"TextformatterSmartypants\",\"title\":\"SmartyPants Typographer\",\"version\":171,\"versionStr\":\"1.7.1\",\"summary\":\"Smart typography for web sites, by Michel Fortin based on SmartyPants by John Gruber. If combined with Markdown, it should be applied AFTER Markdown.\",\"created\":1742133640,\"installed\":false,\"configurable\":4,\"core\":true,\"url\":\"https:\\/\\/github.com\\/michelf\\/php-smartypants\"},\"TextformatterPstripper\":{\"name\":\"TextformatterPstripper\",\"title\":\"Paragraph Stripper\",\"version\":100,\"versionStr\":\"1.0.0\",\"summary\":\"Strips paragraph <p> tags that may have been applied by other text formatters before it. \",\"created\":1742133640,\"installed\":false,\"core\":true},\"SystemNotifications\":{\"name\":\"SystemNotifications\",\"title\":\"System Notifications\",\"version\":12,\"versionStr\":\"0.1.2\",\"summary\":\"Adds support for notifications in ProcessWire (currently in development)\",\"icon\":\"bell\",\"installs\":[\"FieldtypeNotifications\"],\"autoload\":true,\"created\":1742133640,\"installed\":false,\"configurable\":\"SystemNotificationsConfig.php\",\"core\":true},\"FieldtypeNotifications\":{\"name\":\"FieldtypeNotifications\",\"title\":\"Notifications\",\"version\":4,\"versionStr\":\"0.0.4\",\"summary\":\"Field that stores user notifications.\",\"requiresVersions\":{\"SystemNotifications\":[\">=\",0]},\"created\":1742133640,\"installed\":false,\"core\":true},\"PagePaths\":{\"name\":\"PagePaths\",\"title\":\"Page Paths\",\"version\":4,\"versionStr\":\"0.0.4\",\"summary\":\"Enables page paths\\/urls to be queryable by selectors. Also offers potential for improved load performance. Builds an index at install (may take time on a large site).\",\"autoload\":true,\"singular\":true,\"created\":1742133640,\"installed\":false,\"configurable\":4,\"core\":true},\"FileCompilerTags\":{\"name\":\"FileCompilerTags\",\"title\":\"Tags File Compiler\",\"version\":1,\"versionStr\":\"0.0.1\",\"summary\":\"Enables {var} or {var.property} variables in markup sections of a file. Can be used with any API variable.\",\"created\":1742133640,\"installed\":false,\"configurable\":4,\"core\":true},\"PagePathHistory\":{\"name\":\"PagePathHistory\",\"title\":\"Page Path History\",\"version\":8,\"versionStr\":\"0.0.8\",\"summary\":\"Keeps track of past URLs where pages have lived and automatically redirects (301 permanent) to the new location whenever the past URL is accessed.\",\"autoload\":true,\"singular\":true,\"created\":1742133640,\"installed\":false,\"configurable\":4,\"core\":true},\"ImageSizerEngineAnimatedGif\":{\"name\":\"ImageSizerEngineAnimatedGif\",\"title\":\"Animated GIF Image Sizer\",\"version\":1,\"versionStr\":\"0.0.1\",\"author\":\"Horst Nogajski\",\"summary\":\"Upgrades image manipulations for animated GIFs.\",\"created\":1742133640,\"installed\":false,\"configurable\":4,\"core\":true},\"ImageSizerEngineIMagick\":{\"name\":\"ImageSizerEngineIMagick\",\"title\":\"IMagick Image Sizer\",\"version\":3,\"versionStr\":\"0.0.3\",\"author\":\"Horst Nogajski\",\"summary\":\"Upgrades image manipulations to use PHP\'s ImageMagick library when possible.\",\"created\":1742133640,\"installed\":false,\"configurable\":4,\"core\":true},\"InputfieldCKEditor\":{\"name\":\"InputfieldCKEditor\",\"title\":\"CKEditor\",\"version\":172,\"versionStr\":\"1.7.2\",\"summary\":\"CKEditor textarea rich text editor.\",\"installs\":[\"MarkupHTMLPurifier\"],\"created\":1742133640,\"installed\":false,\"core\":true},\"FieldtypeCache\":{\"name\":\"FieldtypeCache\",\"title\":\"Cache\",\"version\":102,\"versionStr\":\"1.0.2\",\"summary\":\"Caches the values of other fields for fewer runtime queries. Can also be used to combine multiple text fields and have them all be searchable under the cached field name.\",\"created\":1742133640,\"installed\":false,\"core\":true},\"FieldtypeDecimal\":{\"name\":\"FieldtypeDecimal\",\"title\":\"Decimal\",\"version\":1,\"versionStr\":\"0.0.1\",\"summary\":\"Field that stores a decimal number\",\"created\":1742133640,\"installed\":false,\"core\":true},\"FieldtypeSelector\":{\"name\":\"FieldtypeSelector\",\"title\":\"Selector\",\"version\":13,\"versionStr\":\"0.1.3\",\"author\":\"Avoine + ProcessWire\",\"summary\":\"Build a page finding selector visually.\",\"created\":1742133640,\"installed\":false,\"core\":true},\"CommentFilterAkismet\":{\"name\":\"CommentFilterAkismet\",\"title\":\"Comment Filter: Akismet\",\"version\":200,\"versionStr\":\"2.0.0\",\"summary\":\"Uses the Akismet service to identify comment spam. Module plugin for the Comments Fieldtype.\",\"requiresVersions\":{\"FieldtypeComments\":[\">=\",0]},\"created\":1742133640,\"installed\":false,\"configurable\":3,\"core\":true},\"PagesVersions\":{\"name\":\"PagesVersions\",\"title\":\"Pages Versions\",\"version\":2,\"versionStr\":\"0.0.2\",\"author\":\"Ryan Cramer\",\"summary\":\"Provides a version control API for pages in ProcessWire.\",\"icon\":\"code-fork\",\"autoload\":true,\"singular\":true,\"created\":1742133640,\"installed\":false,\"core\":true},\"AdminThemeReno\":{\"name\":\"AdminThemeReno\",\"title\":\"Reno\",\"version\":17,\"versionStr\":\"0.1.7\",\"author\":\"Tom Reno (Renobird)\",\"summary\":\"Admin theme for ProcessWire 2.5+ by Tom Reno (Renobird)\",\"requiresVersions\":{\"AdminThemeDefault\":[\">=\",0]},\"autoload\":\"template=admin\",\"created\":1742133640,\"installed\":false,\"configurable\":3,\"core\":true},\"PageFrontEdit\":{\"name\":\"PageFrontEdit\",\"title\":\"Front-End Page Editor\",\"version\":6,\"versionStr\":\"0.0.6\",\"author\":\"Ryan Cramer\",\"summary\":\"Enables front-end editing of page fields.\",\"icon\":\"cube\",\"permissions\":{\"page-edit-front\":\"Use the front-end page editor\"},\"autoload\":true,\"created\":1742133640,\"installed\":false,\"configurable\":\"PageFrontEditConfig.php\",\"core\":true,\"license\":\"MPL 2.0\"},\"FieldtypeTextareaLanguage\":{\"name\":\"FieldtypeTextareaLanguage\",\"title\":\"Textarea (Multi-language)\",\"version\":100,\"versionStr\":\"1.0.0\",\"summary\":\"Field that stores a multiple lines of text in multiple languages\",\"requiresVersions\":{\"LanguageSupportFields\":[\">=\",0]},\"created\":1742133640,\"installed\":false,\"core\":true},\"LanguageSupport\":{\"name\":\"LanguageSupport\",\"title\":\"Languages Support\",\"version\":104,\"versionStr\":\"1.0.4\",\"author\":\"Ryan Cramer\",\"summary\":\"ProcessWire multi-language support.\",\"installs\":[\"ProcessLanguage\",\"ProcessLanguageTranslator\"],\"autoload\":true,\"singular\":true,\"created\":1742133640,\"installed\":false,\"configurable\":3,\"core\":true,\"addFlag\":32},\"LanguageTabs\":{\"name\":\"LanguageTabs\",\"title\":\"Languages Support - Tabs\",\"version\":117,\"versionStr\":\"1.1.7\",\"author\":\"adamspruijt, ryan, flipzoom\",\"summary\":\"Organizes multi-language fields into tabs for a cleaner easier to use interface.\",\"requiresVersions\":{\"LanguageSupport\":[\">=\",0]},\"autoload\":\"template=admin\",\"singular\":true,\"created\":1742133640,\"installed\":false,\"configurable\":4,\"core\":true},\"FieldtypeTextLanguage\":{\"name\":\"FieldtypeTextLanguage\",\"title\":\"Text (Multi-language)\",\"version\":100,\"versionStr\":\"1.0.0\",\"summary\":\"Field that stores a single line of text in multiple languages\",\"requiresVersions\":{\"LanguageSupportFields\":[\">=\",0]},\"created\":1742133640,\"installed\":false,\"core\":true},\"ProcessLanguage\":{\"name\":\"ProcessLanguage\",\"title\":\"Languages\",\"version\":103,\"versionStr\":\"1.0.3\",\"author\":\"Ryan Cramer\",\"summary\":\"Manage system languages\",\"icon\":\"language\",\"requiresVersions\":{\"LanguageSupport\":[\">=\",0]},\"permission\":\"lang-edit\",\"permissions\":{\"lang-edit\":\"Administer languages and static translation files\"},\"created\":1742133640,\"installed\":false,\"configurable\":3,\"core\":true,\"useNavJSON\":true},\"LanguageSupportPageNames\":{\"name\":\"LanguageSupportPageNames\",\"title\":\"Languages Support - Page Names\",\"version\":14,\"versionStr\":\"0.1.4\",\"author\":\"Ryan Cramer\",\"summary\":\"Required to use multi-language page names.\",\"requiresVersions\":{\"LanguageSupport\":[\">=\",0],\"LanguageSupportFields\":[\">=\",0]},\"autoload\":true,\"singular\":true,\"created\":1742133640,\"installed\":false,\"configurable\":4,\"core\":true},\"ProcessLanguageTranslator\":{\"name\":\"ProcessLanguageTranslator\",\"title\":\"Language Translator\",\"version\":103,\"versionStr\":\"1.0.3\",\"author\":\"Ryan Cramer\",\"summary\":\"Provides language translation capabilities for ProcessWire core and modules.\",\"requiresVersions\":{\"LanguageSupport\":[\">=\",0]},\"permission\":\"lang-edit\",\"created\":1742133640,\"installed\":false,\"configurable\":4,\"core\":true},\"LanguageSupportFields\":{\"name\":\"LanguageSupportFields\",\"title\":\"Languages Support - Fields\",\"version\":101,\"versionStr\":\"1.0.1\",\"author\":\"Ryan Cramer\",\"summary\":\"Required to use multi-language fields.\",\"requiresVersions\":{\"LanguageSupport\":[\">=\",0]},\"installs\":[\"FieldtypePageTitleLanguage\",\"FieldtypeTextareaLanguage\",\"FieldtypeTextLanguage\"],\"autoload\":true,\"singular\":true,\"created\":1742133640,\"installed\":false,\"core\":true},\"FieldtypePageTitleLanguage\":{\"name\":\"FieldtypePageTitleLanguage\",\"title\":\"Page Title (Multi-Language)\",\"version\":100,\"versionStr\":\"1.0.0\",\"author\":\"Ryan Cramer\",\"summary\":\"Field that stores a page title in multiple languages. Use this only if you want title inputs created for ALL languages on ALL pages. Otherwise create separate languaged-named title fields, i.e. title_fr, title_es, title_fi, etc. \",\"requiresVersions\":{\"LanguageSupportFields\":[\">=\",0],\"FieldtypeTextLanguage\":[\">=\",0]},\"created\":1742133640,\"installed\":false,\"core\":true},\"HelperFlatFilesBooster\":{\"name\":\"HelperFlatFilesBooster\",\"title\":\"Flat Files Booster\",\"version\":\"1\",\"versionStr\":\"0.0.1\",\"author\":\"rafaoski\",\"summary\":\"This module helps in rendering flat html files instead of connecting to database.\",\"icon\":\"file-code-o\",\"requiresVersions\":{\"ProcessProfileHelper\":[\">=\",0]},\"autoload\":true,\"created\":1742333356,\"installed\":false,\"configurable\":4,\"page\":{\"name\":\"helper-flat-files-booster\",\"parent\":\"setup\",\"title\":\"Flat Files Booster\"}},\"HelperPwa\":{\"name\":\"HelperPwa\",\"title\":\"Helper PWA\",\"version\":1,\"versionStr\":\"0.0.1\",\"author\":\"rafaoski\",\"icon\":\"file-code-o\",\"requiresVersions\":{\"ProcessProfileHelper\":[\">=\",0]},\"autoload\":true,\"created\":1742333356,\"installed\":false,\"configurable\":4}}', '2025-02-15 20:50:18');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('164', '.ModulesVersions.info', '8192', '[]', '2025-02-15 20:50:18');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('175', 'ProcessRecentPages', '1', '', '2025-02-15 20:50:18');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('187', 'AdminThemeUikit', '10', '', '2025-02-15 20:50:18');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('200', 'ProcessLogger', '1', '', '2025-02-15 20:50:20');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('205', 'InputfieldIcon', '0', '', '2025-02-15 20:50:20');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5533', 'FileValidatorSvgSanitizer', '0', '{\"removeRemoteReferences\":1,\"minify\":\"\",\"customTags\":\"\",\"customAttrs\":\"\"}', '2025-02-16 23:07:00');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5538', 'MarkupRSS', '0', '{\"title\":\"Untitled RSS Feed\",\"url\":\"\",\"description\":\"\",\"xsl\":\"\",\"css\":\"\",\"copyright\":\"\",\"itemTitleField\":\"title\",\"itemDateField\":\"created\",\"itemDescriptionField\":\"\",\"itemDescriptionLength\":1024,\"itemContentField\":null,\"ttl\":60}', '2025-02-16 23:09:46');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5543', 'FieldtypeRepeater', '3', '{\"repeatersRootPageID\":1015}', '2025-02-16 23:09:58');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5544', 'InputfieldRepeater', '0', '', '2025-02-16 23:09:58');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5545', 'FieldtypeFieldsetPage', '35', '{\"repeatersRootPageID\":1015}', '2025-02-16 23:09:58');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5550', 'FieldtypeComments', '1', '', '2025-02-16 23:10:12');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5551', 'InputfieldCommentsAdmin', '0', '', '2025-02-16 23:10:12');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5556', 'InputfieldTextTags', '0', '', '2025-02-16 23:10:32');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5561', 'LazyCron', '3', '', '2025-02-16 23:10:46');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5566', 'FieldtypePageTable', '3', '', '2025-02-16 23:11:00');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5567', 'InputfieldPageTable', '0', '', '2025-02-16 23:11:00');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5569', 'InputfieldToggle', '0', '', '2025-02-16 23:11:20');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5570', 'FieldtypeToggle', '1', '', '2025-02-16 23:11:20');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5575', 'ProcessCommentsManager', '1', '', '2025-02-16 23:11:44');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5580', 'ProcessForgotPassword', '1', '{\"emailFrom\":\"\",\"askEmail\":\"\",\"maxPerIP\":3,\"useLog\":1,\"confirmFields\":[\"email:92\"],\"allowRoles\":[],\"blockRoles\":[]}', '2025-02-16 23:11:58');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5585', 'ProcessPageClone', '11', '{\"alwaysUseForm\":\"\"}', '2025-02-16 23:12:10');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5590', 'FieldtypeOptions', '1', '', '2025-02-16 23:12:18');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5595', 'ProcessPagesExportImport', '1', '', '2025-02-16 23:12:33');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5600', 'InputfieldPageAutocomplete', '0', '', '2025-02-16 23:13:12');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5605', 'TextformatterMarkdownExtra', '1', '', '2025-02-16 23:39:28');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5616', 'ProcessProfileHelper', '3', '', '2025-02-21 13:00:24');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5617', 'HelperBackup', '3', '{\"excludeWireFolder\":1,\"limitBackupFiles\":10,\"cronInterval\":\"\",\"onlyCronDatabase\":\"\",\"sendCronFiles\":\"\",\"backupEmail\":\"\"}', '2025-02-21 13:00:24');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5618', 'HelperOembed', '3', '{\"instagram_access_token\":\"Instagram Access Token\",\"facebook_access_token\":\"Facebook Access Token\",\"profiles_img_page_id\":\"1073\",\"duration\":\"21600\",\"clearCache\":\"\"}', '2025-02-21 13:00:24');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5619', 'HelperMaintenance', '3', '', '2025-02-21 13:00:24');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5653', 'LogsJsonViewer', '10', '{\"jsonViewerOptions\":\"expanded: true\\nindent: 2\\nshowDataTypes: false\\ntheme: monokai\\nshowToolbar: true\\nshowSize: true\\nshowCopy: true\\nexpandIconType: square\",\"jsonColumnWidth\":60}', '2025-02-22 20:40:33');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5689', 'PageListCustomChildren', '10', '{\"definitions\":\"template=category >> parent=\\/blog, categories=page.id\"}', '2025-02-28 20:57:44');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5795', 'HelperChat', '3', '{\"enable_chat\":\"\",\"default_system_prompt\":\"You are a helpful assistant for this website.Your main task is to assist users by presenting relevant pages and providing direct links to them when needed.\\nHome  https:\\/\\/pw-starter.ddev.site\\/ \\nAbout  https:\\/\\/pw-starter.ddev.site\\/about\\/ \\nContact  https:\\/\\/pw-starter.ddev.site\\/contact\\/ \\nBlog  https:\\/\\/pw-starter.ddev.site\\/blog\\/ \\nThe Benefits of Using ProcessWire CMS  https:\\/\\/pw-starter.ddev.site\\/blog\\/the-benefits-of-using-processwire-cms\\/ \\nCategories  https:\\/\\/pw-starter.ddev.site\\/categories\\/ \\nCMS  https:\\/\\/pw-starter.ddev.site\\/categories\\/cms\\/ \\nProcessWire  https:\\/\\/pw-starter.ddev.site\\/categories\\/processwire\\/ \\nBoost Your SEO!  https:\\/\\/pw-starter.ddev.site\\/blog\\/boost-your-seo\\/ \\nSEO  https:\\/\\/pw-starter.ddev.site\\/categories\\/seo\\/\",\"ai_model\":\"gpt-4o-mini\",\"api_key\":\"\",\"max_request_per_day\":120,\"max_request_per_session\":40,\"limit_history\":10,\"message_character_limit\":500,\"max_tokens\":300}', '2025-03-06 11:56:51');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5964', 'TextformatterEmoji', '1', '{\"emojiTag\":\":name:\",\"wrapEmoji\":1}', '2025-03-16 14:53:17');
INSERT INTO `modules` (`id`, `class`, `flags`, `data`, `created`) VALUES('5975', 'LoginRegister', '0', '{\"features\":[\"login\",\"login-email\"],\"registerFields\":[\"email\",\"pass\"],\"profileFields\":[\"pass\",\"email\"],\"registerRoles\":[\"login-register:1144\"]}', '2025-03-16 21:34:36');

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL DEFAULT 0,
  `templates_id` int(11) unsigned NOT NULL DEFAULT 0,
  `name` varchar(128) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `status` int(10) unsigned NOT NULL DEFAULT 1,
  `modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_users_id` int(10) unsigned NOT NULL DEFAULT 2,
  `created` timestamp NOT NULL DEFAULT '2015-12-18 06:09:00',
  `created_users_id` int(10) unsigned NOT NULL DEFAULT 2,
  `published` datetime DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_parent_id` (`name`,`parent_id`),
  KEY `parent_id` (`parent_id`),
  KEY `templates_id` (`templates_id`),
  KEY `modified` (`modified`),
  KEY `created` (`created`),
  KEY `status` (`status`),
  KEY `published` (`published`)
) ENGINE=MyISAM AUTO_INCREMENT=1174 DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1', '0', '1', 'home', '9', '2025-03-16 21:29:16', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('2', '1', '2', 'proc', '1035', '2025-03-18 22:33:31', '40', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '11');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('3', '2', '2', 'page', '21', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '4');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('6', '3', '2', 'add', '21', '2025-02-15 20:50:25', '40', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '1');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('7', '1', '2', 'trash', '1039', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '12');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('8', '3', '2', 'list', '21', '2025-02-15 20:50:25', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('9', '3', '2', 'sort', '1047', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '3');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('10', '3', '2', 'edit', '1045', '2025-02-15 20:50:25', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '4');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('11', '22', '2', 'template', '21', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('16', '22', '2', 'field', '21', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '2');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('21', '2', '2', 'module', '21', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '6');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('22', '2', '2', 'setup', '21', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '5');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('23', '2', '2', 'login', '1035', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '10');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('27', '1', '46', 'http404', '1035', '2025-02-17 20:41:15', '41', '2025-02-15 20:49:57', '3', '2025-02-15 20:49:57', '10');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('28', '2', '2', 'access', '13', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '7');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('29', '28', '2', 'users', '29', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('30', '28', '2', 'roles', '29', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '1');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('31', '28', '2', 'permissions', '29', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '2');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('32', '31', '5', 'page-edit', '25', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '2');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('34', '31', '5', 'page-delete', '25', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '3');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('35', '31', '5', 'page-move', '25', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '4');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('36', '31', '5', 'page-view', '25', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('37', '30', '4', 'guest', '25', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('38', '30', '4', 'superuser', '25', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '1');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('40', '29', '3', 'guest', '25', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '1');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('41', '29', '3', 'test', '1', '2025-03-18 22:33:31', '40', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('50', '31', '5', 'page-sort', '25', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '5');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('51', '31', '5', 'page-template', '25', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '6');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('52', '31', '5', 'user-admin', '25', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '10');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('53', '31', '5', 'profile-edit', '1', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '13');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('54', '31', '5', 'page-lock', '1', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '8');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('300', '3', '2', 'search', '1045', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '6');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('301', '3', '2', 'trash', '1047', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '6');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('302', '3', '2', 'link', '1041', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '7');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('303', '3', '2', 'image', '1041', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '8');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('304', '2', '2', 'profile', '1025', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '41', '2025-02-15 20:49:57', '8');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1006', '31', '5', 'page-lister', '1', '2025-02-15 20:49:57', '40', '2025-02-15 20:49:57', '40', '2025-02-15 20:49:57', '9');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1007', '3', '2', 'lister', '1', '2025-02-15 20:49:57', '40', '2025-02-15 20:49:57', '40', '2025-02-15 20:49:57', '9');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1010', '3', '2', 'recent-pages', '1', '2025-02-15 20:50:18', '40', '2025-02-15 20:50:18', '40', '2025-02-15 20:50:18', '10');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1011', '31', '5', 'page-edit-recent', '1', '2025-02-15 20:50:18', '40', '2025-02-15 20:50:18', '40', '2025-02-15 20:50:18', '10');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1012', '22', '2', 'logs', '1', '2025-02-15 20:50:20', '40', '2025-02-15 20:50:20', '40', '2025-02-15 20:50:20', '2');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1013', '31', '5', 'logs-view', '1', '2025-02-15 20:50:20', '40', '2025-02-15 20:50:20', '40', '2025-02-15 20:50:20', '11');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1014', '31', '5', 'logs-edit', '1', '2025-02-15 20:50:20', '40', '2025-02-15 20:50:20', '40', '2025-02-15 20:50:20', '12');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1015', '2', '2', 'repeaters', '1036', '2025-02-16 23:09:58', '41', '2025-02-16 23:09:58', '41', '2025-02-16 23:09:58', '9');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1016', '22', '2', 'comments', '1', '2025-02-16 23:11:44', '41', '2025-02-16 23:11:44', '41', '2025-02-16 23:11:44', '3');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1017', '31', '5', 'comments-manager', '1', '2025-02-16 23:11:44', '41', '2025-02-16 23:11:44', '41', '2025-02-16 23:11:44', '13');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1018', '3', '2', 'clone', '1024', '2025-02-16 23:12:10', '41', '2025-02-16 23:12:10', '41', '2025-02-16 23:12:10', '10');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1019', '31', '5', 'page-clone', '1', '2025-02-16 23:12:10', '41', '2025-02-16 23:12:10', '41', '2025-02-16 23:12:10', '14');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1020', '31', '5', 'page-clone-tree', '1', '2025-02-16 23:12:10', '41', '2025-02-16 23:12:10', '41', '2025-02-16 23:12:10', '15');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1021', '3', '2', 'export-import', '1', '2025-02-16 23:12:33', '41', '2025-02-16 23:12:33', '41', '2025-02-16 23:12:33', '11');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1022', '1015', '2', 'for-field-98', '17', '2025-02-16 23:17:56', '41', '2025-02-16 23:13:46', '41', '2025-02-16 23:13:46', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1023', '1022', '43', 'for-page-1', '1', '2025-03-16 21:29:16', '41', '2025-02-16 23:21:55', '41', '2025-02-16 23:21:55', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1024', '1015', '2', 'for-field-104', '17', '2025-02-16 23:37:45', '41', '2025-02-16 23:37:45', '41', '2025-02-16 23:37:45', '1');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1025', '1024', '44', 'for-page-1', '1', '2025-03-16 21:29:16', '41', '2025-02-16 23:38:40', '41', '2025-02-16 23:38:40', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1026', '1024', '44', 'for-page-27', '1025', '2025-02-17 20:41:15', '41', '2025-02-17 11:30:33', '40', '2025-02-17 11:30:33', '1');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1027', '1', '29', 'about', '1', '2025-03-12 23:59:19', '41', '2025-02-17 14:10:36', '41', '2025-02-17 14:10:38', '3');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1028', '1024', '44', 'for-page-1027', '1', '2025-03-12 23:59:19', '41', '2025-02-17 14:10:36', '41', '2025-02-17 14:10:38', '2');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1029', '2', '45', 'adv-opt', '1029', '2025-03-11 08:30:34', '41', '2025-02-17 20:29:44', '41', '2025-02-17 20:29:45', '1');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1030', '1', '48', 'personal-data', '1025', '2025-03-04 23:02:37', '41', '2025-02-18 22:33:41', '41', '2025-02-18 22:33:42', '9');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1031', '1024', '44', 'for-page-1030', '1025', '2025-03-04 23:02:37', '41', '2025-02-18 22:33:41', '41', '2025-02-18 22:33:42', '3');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1032', '1', '47', 'contact', '1', '2025-03-10 22:05:12', '41', '2025-02-18 22:34:47', '41', '2025-02-18 22:34:49', '4');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1033', '1024', '44', 'for-page-1032', '1', '2025-03-10 22:05:12', '41', '2025-02-18 22:34:47', '41', '2025-02-18 22:34:49', '4');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1034', '1029', '45', 'sgv_logs', '1029', '2025-02-24 13:53:04', '41', '2025-02-20 21:19:47', '41', '2025-02-20 21:19:47', '4');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1035', '1029', '45', 'enable_csp', '1029', '2025-02-24 13:52:48', '41', '2025-02-20 21:27:33', '41', '2025-02-20 21:27:36', '8');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1036', '1029', '49', 'ga_code', '1025', '2025-02-20 21:42:58', '41', '2025-02-20 21:33:35', '41', '2025-02-20 21:33:38', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1037', '1029', '49', 'gv_code', '1025', '2025-02-20 21:43:08', '41', '2025-02-20 21:40:51', '41', '2025-02-20 21:40:53', '1');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1038', '1029', '49', 'copyright', '1025', '2025-03-07 23:27:54', '41', '2025-02-20 21:54:52', '41', '2025-02-20 21:56:41', '2');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1039', '1029', '45', 'disable_comments', '1029', '2025-02-24 13:53:07', '41', '2025-02-20 22:10:20', '41', '2025-02-20 22:10:20', '3');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1040', '1029', '45', 'disable_cf', '1029', '2025-02-20 22:12:16', '41', '2025-02-20 22:12:07', '41', '2025-02-20 22:12:08', '6');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1041', '2', '45', 'social_profiles', '1029', '2025-02-20 22:17:14', '41', '2025-02-20 22:14:42', '41', '2025-02-20 22:14:42', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1042', '1041', '49', 'x', '1025', '2025-02-20 22:17:10', '41', '2025-02-20 22:16:03', '41', '2025-02-20 22:16:23', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1043', '1041', '49', 'facebook', '1025', '2025-02-20 22:20:06', '41', '2025-02-20 22:19:43', '41', '2025-02-20 22:19:45', '1');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1044', '1041', '49', 'youtube', '1025', '2025-02-20 22:20:47', '41', '2025-02-20 22:20:23', '41', '2025-02-20 22:20:41', '2');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1045', '1041', '49', 'tiktok', '1025', '2025-02-20 22:21:52', '41', '2025-02-20 22:21:05', '41', '2025-02-20 22:21:07', '3');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1046', '1041', '49', 'instagram', '1025', '2025-02-20 22:22:37', '41', '2025-02-20 22:22:05', '41', '2025-02-20 22:22:28', '4');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1047', '1041', '49', 'linkedin', '1025', '2025-02-20 22:23:30', '41', '2025-02-20 22:22:51', '41', '2025-02-20 22:23:25', '5');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1048', '1041', '49', 'snapchat', '1025', '2025-02-20 22:24:36', '41', '2025-02-20 22:23:48', '41', '2025-02-20 22:24:27', '6');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1049', '1041', '49', 'github', '1025', '2025-02-20 22:25:34', '41', '2025-02-20 22:25:13', '41', '2025-02-20 22:25:29', '7');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1050', '1015', '2', 'for-field-109', '17', '2025-02-20 22:57:11', '41', '2025-02-20 22:57:11', '41', '2025-02-20 22:57:11', '2');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1051', '1050', '50', 'for-page-1032', '1', '2025-03-10 22:05:12', '41', '2025-02-20 23:00:45', '41', '2025-02-20 23:00:45', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1052', '1015', '2', 'for-field-111', '17', '2025-03-07 23:09:19', '41', '2025-02-20 23:52:31', '41', '2025-02-20 23:52:31', '3');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1053', '1015', '2', 'for-field-112', '17', '2025-02-20 23:54:01', '41', '2025-02-20 23:54:01', '41', '2025-02-20 23:54:01', '4');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1054', '1052', '2', 'for-page-1', '17', '2025-02-20 23:58:55', '41', '2025-02-20 23:58:55', '41', '2025-02-20 23:58:55', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1055', '1054', '51', '1740092338-6264-1', '1', '2025-02-21 00:35:25', '41', '2025-02-20 23:58:58', '41', '2025-02-21 00:00:27', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1056', '1053', '52', 'for-page-1055', '1', '2025-02-21 00:35:25', '41', '2025-02-20 23:58:58', '41', '2025-02-21 00:00:27', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1057', '1054', '51', '1740092522-763-1', '1', '2025-02-21 12:52:58', '41', '2025-02-21 00:02:02', '41', '2025-02-21 00:02:08', '1');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1058', '1053', '52', 'for-page-1057', '1', '2025-02-21 12:52:58', '41', '2025-02-21 00:02:02', '41', '2025-02-21 00:02:02', '1');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1065', '22', '2', 'profile-helper', '1', '2025-02-21 13:00:24', '41', '2025-02-21 13:00:24', '41', '2025-02-21 13:00:24', '4');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1066', '31', '5', 'profilehelper', '1', '2025-02-21 13:00:24', '41', '2025-02-21 13:00:24', '41', '2025-02-21 13:00:24', '16');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1067', '22', '2', 'helper-backup', '1', '2025-02-21 13:00:24', '41', '2025-02-21 13:00:24', '41', '2025-02-21 13:00:24', '5');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1068', '22', '2', 'helper-oembed', '1', '2025-02-21 13:00:24', '41', '2025-02-21 13:00:24', '41', '2025-02-21 13:00:24', '6');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1070', '1029', '45', 'save_cf-logs', '1029', '2025-02-24 13:52:34', '41', '2025-02-22 20:38:36', '41', '2025-02-22 20:38:42', '5');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1071', '1015', '2', 'for-field-116', '17', '2025-02-23 10:31:07', '41', '2025-02-23 10:31:07', '41', '2025-02-23 10:31:07', '5');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1072', '1071', '53', 'for-page-1', '1', '2025-03-16 21:29:16', '41', '2025-02-23 10:41:34', '41', '2025-02-23 10:41:34', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1073', '2', '54', 'oembed_images', '1025', '2025-02-26 15:01:43', '41', '2025-02-23 12:25:04', '41', '2025-02-23 12:25:05', '2');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1074', '1071', '53', 'for-page-1027', '1', '2025-03-12 23:59:19', '41', '2025-02-23 12:31:49', '41', '2025-02-23 12:31:49', '1');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1077', '2', '45', 'content-blocks', '1029', '2025-02-23 15:21:23', '41', '2025-02-23 15:21:10', '41', '2025-02-23 15:21:10', '3');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1080', '1071', '53', 'for-page-1032', '1', '2025-03-10 22:05:12', '41', '2025-02-23 23:03:23', '41', '2025-02-23 23:03:23', '2');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1086', '1071', '53', 'for-page-1030', '1025', '2025-03-04 23:02:37', '41', '2025-02-24 13:51:06', '41', '2025-02-24 13:51:06', '3');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1087', '1071', '53', 'for-page-27', '1', '2025-02-24 13:54:56', '41', '2025-02-24 13:54:56', '41', '2025-02-24 13:54:56', '4');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1088', '1', '60', 'blog', '1', '2025-03-12 23:52:01', '41', '2025-02-25 22:30:35', '41', '2025-02-25 22:30:37', '5');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1089', '1071', '53', 'for-page-1088', '1', '2025-03-12 23:52:01', '41', '2025-02-25 22:30:35', '41', '2025-02-25 22:30:37', '5');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1090', '1024', '44', 'for-page-1088', '1', '2025-03-12 23:52:01', '41', '2025-02-25 22:30:35', '41', '2025-02-25 22:30:37', '5');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1091', '1088', '62', 'the-benefits-of-using-processwire-cms', '0', '2025-03-16 14:55:02', '41', '2025-02-25 22:30:45', '41', '2025-03-12 23:49:42', '1');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1092', '1071', '53', 'for-page-1091', '1', '2025-03-16 14:55:02', '41', '2025-02-25 22:30:45', '41', '2025-03-12 23:49:42', '6');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1093', '1024', '44', 'for-page-1091', '1', '2025-03-16 14:55:02', '41', '2025-02-25 22:30:45', '41', '2025-03-12 23:49:42', '6');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1094', '1', '59', 'categories', '1', '2025-02-25 22:32:09', '41', '2025-02-25 22:32:07', '41', '2025-02-25 22:32:09', '6');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1095', '1071', '53', 'for-page-1094', '1', '2025-02-25 22:32:09', '41', '2025-02-25 22:32:07', '41', '2025-02-25 22:32:09', '7');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1096', '1024', '44', 'for-page-1094', '1', '2025-02-25 22:32:09', '41', '2025-02-25 22:32:07', '41', '2025-02-25 22:32:09', '7');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1097', '1094', '61', 'cms', '1', '2025-02-25 22:33:47', '41', '2025-02-25 22:33:45', '41', '2025-02-25 22:33:47', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1098', '1024', '44', 'for-page-1097', '1', '2025-02-25 22:33:47', '41', '2025-02-25 22:33:45', '41', '2025-02-25 22:33:47', '8');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1099', '1071', '53', 'for-page-1097', '1', '2025-02-25 22:33:47', '41', '2025-02-25 22:33:45', '41', '2025-02-25 22:33:47', '8');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1100', '1094', '61', 'processwire', '1', '2025-02-25 22:33:58', '41', '2025-02-25 22:33:57', '41', '2025-02-25 22:33:58', '1');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1101', '1024', '44', 'for-page-1100', '1', '2025-02-25 22:33:58', '41', '2025-02-25 22:33:57', '41', '2025-02-25 22:33:58', '9');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1102', '1071', '53', 'for-page-1100', '1', '2025-02-25 22:33:58', '41', '2025-02-25 22:33:57', '41', '2025-02-25 22:33:58', '9');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1105', '1', '63', 'sitemap', '1029', '2025-03-11 15:13:22', '41', '2025-03-04 19:48:34', '41', '2025-03-04 19:48:39', '8');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1106', '1024', '44', 'for-page-1105', '1025', '2025-03-11 15:13:22', '41', '2025-03-04 19:48:34', '41', '2025-03-04 19:48:39', '10');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1107', '1071', '53', 'for-page-1105', '1025', '2025-03-11 15:13:22', '41', '2025-03-04 19:48:34', '41', '2025-03-04 19:48:39', '10');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1108', '1088', '62', 'boost-your-seo', '1', '2025-03-12 23:49:28', '41', '2025-03-07 21:11:13', '41', '2025-03-12 23:49:28', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1109', '1024', '44', 'for-page-1108', '1', '2025-03-12 23:49:28', '41', '2025-03-07 21:11:13', '41', '2025-03-12 23:49:28', '11');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1110', '1071', '53', 'for-page-1108', '1', '2025-03-12 23:49:28', '41', '2025-03-07 21:11:13', '41', '2025-03-12 23:49:28', '11');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1111', '1094', '61', 'seo', '1', '2025-03-07 21:11:54', '41', '2025-03-07 21:11:54', '41', '2025-03-07 21:11:54', '2');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1112', '1024', '44', 'for-page-1111', '1', '2025-03-07 21:11:54', '41', '2025-03-07 21:11:54', '41', '2025-03-07 21:11:54', '12');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1113', '1071', '53', 'for-page-1111', '1', '2025-03-07 21:11:54', '41', '2025-03-07 21:11:54', '41', '2025-03-07 21:11:54', '12');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1124', '1077', '57', '20250310-210351', '1', '2025-03-10 21:11:34', '41', '2025-03-10 21:03:51', '41', '2025-03-10 21:04:25', '0');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1128', '1077', '57', '20250310-213645', '1', '2025-03-16 14:41:59', '41', '2025-03-10 21:36:45', '41', '2025-03-10 21:37:15', '3');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1138', '1029', '45', 'hx_boost', '1029', '2025-03-11 08:32:39', '41', '2025-03-11 08:30:05', '41', '2025-03-11 08:30:22', '7');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1139', '1054', '51', '1741702439-1499-1', '3073', '2025-03-11 15:15:26', '41', '2025-03-11 15:13:59', '41', NULL, '2');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1140', '1053', '52', 'for-page-1139', '3073', '2025-03-11 15:13:59', '41', '2025-03-11 15:13:59', '41', '2025-03-11 15:13:59', '2');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1141', '1077', '58', '20250314-115056', '1', '2025-03-14 11:51:56', '41', '2025-03-14 11:50:56', '41', '2025-03-14 11:51:56', '3');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1142', '1077', '57', '20250316-143506', '1', '2025-03-16 14:36:45', '41', '2025-03-16 14:35:06', '41', '2025-03-16 14:36:24', '3');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1143', '1', '65', 'user-zone', '3077', '2025-03-16 23:37:02', '41', '2025-03-16 21:28:38', '41', '2025-03-16 21:28:38', '7');
INSERT INTO `pages` (`id`, `parent_id`, `templates_id`, `name`, `status`, `modified`, `modified_users_id`, `created`, `created_users_id`, `published`, `sort`) VALUES('1144', '30', '4', 'login-register', '1', '2025-03-16 21:34:36', '41', '2025-03-16 21:34:36', '41', '2025-03-16 21:34:36', '2');

DROP TABLE IF EXISTS `pages_access`;
CREATE TABLE `pages_access` (
  `pages_id` int(11) NOT NULL,
  `templates_id` int(11) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`pages_id`),
  KEY `templates_id` (`templates_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('27', '1', '2025-02-17 20:41:15');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('32', '2', '2025-02-15 20:49:57');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('34', '2', '2025-02-15 20:49:57');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('35', '2', '2025-02-15 20:49:57');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('36', '2', '2025-02-15 20:49:57');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('37', '2', '2025-02-15 20:49:57');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('38', '2', '2025-02-15 20:49:57');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('50', '2', '2025-02-15 20:49:57');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('51', '2', '2025-02-15 20:49:57');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('52', '2', '2025-02-15 20:49:57');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('53', '2', '2025-02-15 20:49:57');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('54', '2', '2025-02-15 20:49:57');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1006', '2', '2025-02-15 20:49:57');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1011', '2', '2025-02-15 20:50:18');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1013', '2', '2025-02-15 20:50:20');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1014', '2', '2025-02-15 20:50:20');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1017', '2', '2025-02-16 23:11:44');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1019', '2', '2025-02-16 23:12:10');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1020', '2', '2025-02-16 23:12:10');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1023', '2', '2025-02-16 23:21:55');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1025', '2', '2025-02-16 23:38:40');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1026', '2', '2025-02-17 11:30:33');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1027', '1', '2025-02-17 14:10:36');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1028', '2', '2025-02-17 14:10:36');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1029', '2', '2025-02-17 20:29:44');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1030', '1', '2025-02-18 22:33:41');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1031', '2', '2025-02-18 22:33:41');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1032', '1', '2025-02-18 22:34:47');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1033', '2', '2025-02-18 22:34:47');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1034', '2', '2025-02-20 21:19:47');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1035', '2', '2025-02-20 21:27:33');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1036', '2', '2025-02-20 21:33:35');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1037', '2', '2025-02-20 21:40:51');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1038', '2', '2025-02-20 21:54:52');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1039', '2', '2025-02-20 22:10:20');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1040', '2', '2025-02-20 22:12:07');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1041', '2', '2025-02-20 22:14:42');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1042', '2', '2025-02-20 22:16:03');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1043', '2', '2025-02-20 22:19:43');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1044', '2', '2025-02-20 22:20:23');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1045', '2', '2025-02-20 22:21:05');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1046', '2', '2025-02-20 22:22:05');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1047', '2', '2025-02-20 22:22:51');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1048', '2', '2025-02-20 22:23:48');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1049', '2', '2025-02-20 22:25:13');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1051', '2', '2025-02-20 23:00:45');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1055', '2', '2025-02-20 23:58:58');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1056', '2', '2025-02-20 23:58:58');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1057', '2', '2025-02-21 00:02:02');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1058', '2', '2025-02-21 00:02:02');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1066', '2', '2025-02-21 13:00:24');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1070', '2', '2025-02-22 20:38:36');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1072', '2', '2025-02-23 10:41:34');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1073', '2', '2025-02-23 12:25:04');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1074', '2', '2025-02-23 12:31:49');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1077', '2', '2025-02-23 15:21:10');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1080', '2', '2025-02-23 23:03:23');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1086', '2', '2025-02-24 13:51:06');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1087', '2', '2025-02-24 13:54:56');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1088', '1', '2025-02-25 22:30:35');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1089', '2', '2025-02-25 22:30:35');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1090', '2', '2025-02-25 22:30:35');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1091', '1', '2025-02-25 22:30:45');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1092', '2', '2025-02-25 22:30:45');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1093', '2', '2025-02-25 22:30:45');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1094', '1', '2025-02-25 22:32:07');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1095', '2', '2025-02-25 22:32:07');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1096', '2', '2025-02-25 22:32:07');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1097', '1', '2025-02-25 22:33:45');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1098', '2', '2025-02-25 22:33:45');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1099', '2', '2025-02-25 22:33:45');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1100', '1', '2025-02-25 22:33:57');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1101', '2', '2025-02-25 22:33:57');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1102', '2', '2025-02-25 22:33:57');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1105', '1', '2025-03-04 19:48:34');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1106', '2', '2025-03-04 19:48:34');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1107', '2', '2025-03-04 19:48:34');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1108', '1', '2025-03-07 21:11:13');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1109', '2', '2025-03-07 21:11:13');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1110', '2', '2025-03-07 21:11:13');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1111', '1', '2025-03-07 21:11:54');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1112', '2', '2025-03-07 21:11:54');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1113', '2', '2025-03-07 21:11:54');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1124', '2', '2025-03-10 21:03:51');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1128', '2', '2025-03-10 21:36:45');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1138', '2', '2025-03-11 08:30:05');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1139', '2', '2025-03-11 15:13:59');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1140', '2', '2025-03-11 15:13:59');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1141', '2', '2025-03-14 11:50:56');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1142', '2', '2025-03-16 14:35:06');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1143', '1', '2025-03-16 21:28:38');
INSERT INTO `pages_access` (`pages_id`, `templates_id`, `ts`) VALUES('1144', '2', '2025-03-16 21:34:36');

DROP TABLE IF EXISTS `pages_parents`;
CREATE TABLE `pages_parents` (
  `pages_id` int(10) unsigned NOT NULL,
  `parents_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pages_id`,`parents_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('2', '1');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('3', '1');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('3', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('7', '1');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('22', '1');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('22', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('28', '1');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('28', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('29', '1');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('29', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('29', '28');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('30', '1');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('30', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('30', '28');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('31', '1');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('31', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('31', '28');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('41', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('41', '28');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('41', '29');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1015', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1022', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1022', '1015');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1024', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1024', '1015');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1029', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1041', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1050', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1050', '1015');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1052', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1052', '1015');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1053', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1053', '1015');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1054', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1054', '1015');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1054', '1052');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1071', '2');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1071', '1015');
INSERT INTO `pages_parents` (`pages_id`, `parents_id`) VALUES('1077', '2');

DROP TABLE IF EXISTS `pages_sortfields`;
CREATE TABLE `pages_sortfields` (
  `pages_id` int(10) unsigned NOT NULL DEFAULT 0,
  `sortfield` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`pages_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `pages_sortfields` (`pages_id`, `sortfield`) VALUES('1088', '-published');

DROP TABLE IF EXISTS `process_forgot_password`;
CREATE TABLE `process_forgot_password` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `token` char(32) NOT NULL,
  `ts` int(10) unsigned NOT NULL,
  `ip` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `ts` (`ts`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_general_ci;


DROP TABLE IF EXISTS `session_login_throttle`;
CREATE TABLE `session_login_throttle` (
  `name` varchar(128) NOT NULL,
  `attempts` int(10) unsigned NOT NULL DEFAULT 0,
  `last_attempt` int(10) unsigned NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `templates`;
CREATE TABLE `templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `fieldgroups_id` int(10) unsigned NOT NULL DEFAULT 0,
  `flags` int(11) NOT NULL DEFAULT 0,
  `cache_time` mediumint(9) NOT NULL DEFAULT 0,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `fieldgroups_id` (`fieldgroups_id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('1', 'home', '1', '0', '0', '{\"useRoles\":1,\"noParents\":1,\"slashUrls\":1,\"pageLabelField\":\"fa-home title\",\"compile\":0,\"modified\":1742332556,\"ns\":\"ProcessWire\",\"_lazy\":1,\"roles\":[37]}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('2', 'admin', '2', '8', '0', '{\"useRoles\":1,\"parentTemplates\":[2],\"allowPageNum\":1,\"redirectLogin\":23,\"slashUrls\":1,\"noGlobal\":1,\"compile\":3,\"modified\":1742332556,\"ns\":\"ProcessWire\",\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('3', 'user', '3', '8', '0', '{\"useRoles\":1,\"noChildren\":1,\"parentTemplates\":[2],\"slashUrls\":1,\"pageClass\":\"User\",\"noGlobal\":1,\"noMove\":1,\"noTrash\":1,\"noSettings\":1,\"noChangeTemplate\":1,\"nameContentTab\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('4', 'role', '4', '8', '0', '{\"noChildren\":1,\"parentTemplates\":[2],\"slashUrls\":1,\"pageClass\":\"Role\",\"noGlobal\":1,\"noMove\":1,\"noTrash\":1,\"noSettings\":1,\"noChangeTemplate\":1,\"nameContentTab\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('5', 'permission', '5', '8', '0', '{\"noChildren\":1,\"parentTemplates\":[2],\"slashUrls\":1,\"guestSearchable\":1,\"pageClass\":\"Permission\",\"noGlobal\":1,\"noMove\":1,\"noTrash\":1,\"noSettings\":1,\"noChangeTemplate\":1,\"nameContentTab\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('29', 'basic-page', '83', '0', '0', '{\"slashUrls\":1,\"pageLabelField\":\"fa-book title\",\"compile\":0,\"modified\":1742332556,\"ns\":\"ProcessWire\",\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('43', 'repeater_opt', '97', '8', '0', '{\"noChildren\":1,\"noParents\":1,\"slashUrls\":1,\"pageClass\":\"FieldsetPage\",\"pageLabelField\":\"for_page_path\",\"noGlobal\":1,\"compile\":3,\"modified\":1739744276,\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('44', 'repeater_seo', '98', '8', '0', '{\"noChildren\":1,\"noParents\":1,\"slashUrls\":1,\"pageClass\":\"FieldsetPage\",\"pageLabelField\":\"for_page_path\",\"noGlobal\":1,\"compile\":3,\"modified\":1739745465}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('45', '_adv-opt', '99', '0', '0', '{\"parentTemplates\":[45,2,55],\"slashUrls\":1,\"pageLabelField\":\"fa-cog title\",\"compile\":0,\"tags\":\"opt\",\"modified\":1740320506,\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('46', 'http404', '100', '0', '0', '{\"noChildren\":1,\"noParents\":-1,\"slashUrls\":1,\"pageLabelField\":\"fa-shower title\",\"compile\":0,\"modified\":1742332556,\"ns\":\"ProcessWire\",\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('47', 'contact', '101', '0', '0', '{\"noParents\":-1,\"slashUrls\":1,\"pageLabelField\":\"fa-black-tie title\",\"compile\":0,\"modified\":1742332556,\"ns\":\"ProcessWire\",\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('48', 'personal-data', '102', '0', '0', '{\"noParents\":-1,\"slashUrls\":1,\"pageLabelField\":\"fa-unlock-alt title\",\"compile\":0,\"modified\":1742332556,\"ns\":\"ProcessWire\",\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('49', '_opt-txt', '103', '0', '0', '{\"parentTemplates\":[45],\"slashUrls\":1,\"pageLabelField\":\"fa-text-width title\",\"compile\":0,\"tags\":\"opt\",\"modified\":1740086694,\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('50', 'repeater_contact_info', '104', '8', '0', '{\"noChildren\":1,\"noParents\":1,\"slashUrls\":1,\"pageClass\":\"FieldsetPage\",\"pageLabelField\":\"for_page_path\",\"noGlobal\":1,\"compile\":3,\"modified\":1740088631}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('51', 'repeater_useful_links', '105', '8', '0', '{\"noChildren\":1,\"noParents\":1,\"slashUrls\":1,\"pageClass\":\"RepeaterPage\",\"noGlobal\":1,\"compile\":3,\"modified\":1741385359,\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('52', 'repeater_link', '106', '8', '0', '{\"noChildren\":1,\"noParents\":1,\"slashUrls\":1,\"pageClass\":\"FieldsetPage\",\"pageLabelField\":\"for_page_path\",\"noGlobal\":1,\"compile\":3,\"modified\":1740092041}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('53', 'repeater_guest_notification', '107', '8', '0', '{\"noChildren\":1,\"noParents\":1,\"slashUrls\":1,\"pageClass\":\"FieldsetPage\",\"pageLabelField\":\"for_page_path\",\"noGlobal\":1,\"compile\":3,\"modified\":1740303067}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('54', '_opt-img', '108', '0', '0', '{\"parentTemplates\":[2,45],\"slashUrls\":1,\"pageLabelField\":\"fa-picture-o title\",\"compile\":0,\"tags\":\"opt\",\"modified\":1740320219,\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('55', '_blockImages', '109', '0', '0', '{\"parentTemplates\":[45],\"slashUrls\":1,\"pageLabelField\":\"fa-cube title\",\"compile\":0,\"label\":\"Block images\",\"tags\":\"content-block\",\"modified\":1740399460,\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('56', 'field-block_images', '110', '0', '0', '{\"noParents\":1,\"slashUrls\":1,\"pageLabelField\":\"fa-file-image-o\",\"noGlobal\":true,\"compile\":0,\"tags\":\"content-block\",\"modified\":1740399416,\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('57', '_blockContent', '111', '0', '0', '{\"parentTemplates\":[45],\"slashUrls\":1,\"pageLabelField\":\"fa-cube title\",\"compile\":0,\"label\":\"Block content\",\"tags\":\"content-block\",\"modified\":1741639374,\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('58', '_blockPhiki', '112', '0', '0', '{\"parentTemplates\":[45],\"slashUrls\":1,\"pageLabelField\":\"fa-cube title\",\"compile\":0,\"label\":\"Block phiki\",\"modified\":1741641340,\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('59', 'categories', '113', '0', '0', '{\"noParents\":-1,\"childTemplates\":[61],\"allowPageNum\":1,\"slashUrls\":1,\"pageLabelField\":\"fa-th-large title\",\"compile\":0,\"tags\":\"blog\",\"modified\":1742332556,\"ns\":\"ProcessWire\",\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('60', 'blog', '114', '0', '0', '{\"noParents\":-1,\"childTemplates\":[62],\"allowPageNum\":1,\"slashUrls\":1,\"pageLabelField\":\"fa-coffee title\",\"compile\":0,\"tags\":\"blog\",\"modified\":1742332556,\"ns\":\"ProcessWire\",\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('61', 'category', '115', '0', '0', '{\"parentTemplates\":[59],\"slashUrls\":1,\"pageLabelField\":\"fa-square-o title\",\"compile\":0,\"label\":\"Category\",\"tags\":\"blog\",\"modified\":1742332556,\"ns\":\"ProcessWire\",\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('62', 'blog-post', '116', '0', '0', '{\"childTemplates\":[62],\"parentTemplates\":[60],\"allowPageNum\":1,\"slashUrls\":1,\"pageLabelField\":\"fa-file-text-o title\",\"compile\":0,\"label\":\"Post\",\"tags\":\"blog\",\"modified\":1742332556,\"ns\":\"ProcessWire\",\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('63', 'sitemap', '117', '0', '0', '{\"noChildren\":1,\"noParents\":-1,\"slashUrls\":1,\"pageLabelField\":\"fa-map-signs title\",\"compile\":0,\"modified\":1742332556,\"ns\":\"ProcessWire\",\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('65', 'user-zone', '119', '0', '0', '{\"noChildren\":1,\"noParents\":-1,\"slashUrls\":1,\"pageLabelField\":\"fa-user-o title\",\"compile\":0,\"modified\":1742332556,\"ns\":\"ProcessWire\",\"_lazy\":1}');
INSERT INTO `templates` (`id`, `name`, `fieldgroups_id`, `flags`, `cache_time`, `data`) VALUES('66', 'user-todo', '120', '0', '0', '{\"noChildren\":1,\"parentTemplates\":[3],\"slashUrls\":1,\"pageLabelField\":\"fa-magic title\",\"compile\":0,\"modified\":1742158334,\"_lazy\":1}');

UPDATE pages SET created_users_id=41, modified_users_id=41, created=NOW(), modified=NOW();

# --- /WireDatabaseBackup {"numTables":48,"numCreateTables":54,"numInserts":1129,"numSeconds":0}