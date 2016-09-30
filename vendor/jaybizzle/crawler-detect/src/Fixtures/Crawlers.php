<?php

/*
 * This file is part of Crawler Detect - the web crawler detection library.
 *
 * (c) Mark Beech <m@rkbee.ch>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jaybizzle\CrawlerDetect\Fixtures;

class Crawlers extends AbstractProvider
{
    /**
     * Array of regular expressions to match against the user agent.
     *
     * @var array
     */
    protected $data = array(
        '.*Java.*outbrain',
        '008\/',
        '192.comAgent',
        '2ip\.ru',
        '404checker',
        '^bluefish ',
        '^FDM ',
        '^Java\/',
        '^NG\/[0-9\.]',
        '^NING\/',
        '^PHP\/[0-9]',
        '^Ruby|Ruby\/[0-9]',
        '^VSE\/[0-9]',
        '^WordPress\.com',
        '^XRL\/[0-9]',
        'a3logics\.in',
        'A6-Indexer',
        'a\.pr-cy\.ru',
        'Aboundex',
        'aboutthedomain',
        'Accoona-AI-Agent',
        'acoon',
        'acrylicapps\.com\/pulp',
        'adbeat',
        'AddThis',
        'ADmantX',
        'adressendeutschland',
        'Advanced Email Extractor v',
        'agentslug',
        'AHC',
        'aihit',
        'aiohttp\/',
        'Airmail',
        'akula\/',
        'alertra',
        'alexa site audit',
        'alyze\.info',
        'amagit',
        'AndroidDownloadManager',
        'Anemone',
        'Ant\.com',
        'Anturis Agent',
        'AnyEvent-HTTP\/',
        'Apache-HttpClient\/',
        'AportWorm\/[0-9]',
        'AppEngine-Google',
        'Arachmo',
        'arachnode',
        'Arachnophilia',
        'archive-com',
        'aria2',
        'asafaweb.com',
        'AskQuickly',
        'Astute',
        'autocite',
        'Autonomy',
        'B-l-i-t-z-B-O-T',
        'Backlink-Ceck\.de',
        'Bad-Neighborhood',
        'baidu\.com',
        'baypup\/[0-9]',
        'baypup\/colbert',
        'BazQux',
        'BCKLINKS',
        'BDFetch',
        'BegunAdvertising\/',
        'bibnum\.bnf',
        'BigBozz',
        'biglotron',
        'BingLocalSearch',
        'BingPreview',
        'binlar',
        'Blackboard Safeassign',
        'Bloglovin',
        'BlogPulseLive',
        'BlogSearch',
        'Blogtrottr',
        'BoardReader Favicon Fetcher',
        'boitho\.com-dc',
        'BPImageWalker',
        'Branch-Passthrough',
        'Branch Metrics API',
        'Browsershots',
        'BUbiNG',
        'Butterfly\/',
        'BuzzSumo',
        'CakePHP',
        'CapsuleChecker',
        'CaretNail',
        'cb crawl',
        'CC Metadata Scaper',
        'Cerberian Drtrs',
        'cg-eye',
        'changedetection',
        'Charlotte',
        'CheckHost',
        'CirrusExplorer\/',
        'CISPA Vulnerability Notification',
        'clips\.ua\.ac\.be',
        'CloudFlare-AlwaysOnline',
        'cmcm\.com',
        'coccoc',
        'CommaFeed',
        'Commons-HttpClient',
        'Comodo SSL Checker',
        'contactbigdatafr',
        'convera',
        'copyright sheriff',
        'cosmos\/[0-9]',
        'Covario-IDS',
        'cron-job\.org',
        'Crowsnest',
        'curb',
        'Curious George',
        'curl',
        'cuwhois\/[0-9]',
        'CyberPatrol',
        'cybo\.com',
        'DareBoost',
        'DataparkSearch',
        'dataprovider',
        'Daum(oa)?[ \/][0-9]',
        'DeuSu',
        'developers\.google\.com\/\+\/web\/snippet\/',
        'Digg',
        'Dispatch\/',
        'dlvr',
        'DNS-Tools Header-Analyzer',
        'docoloc',
        'DomainAppender',
        'dotSemantic',
        'downforeveryoneorjustme',
        'downnotifier\.com',
        'DowntimeDetector',
        'Dragonfly File Reader',
        'drupact',
        'Drupal (\+http:\/\/drupal\.org\/)',
        'dubaiindex',
        'EARTHCOM',
        'Easy-Thumb',
        'ec2linkfinder',
        'eCairn-Grabber',
        'ECCP',
        'ElectricMonk',
        'elefent',
        'EMail Exractor',
        'EmailWolf',
        'Embed PHP Library',
        'Embedly',
        'europarchive\.org',
        'EventMachine HttpClient',
        'Evidon',
        'Evrinid',
        'ExactSearch',
        'ExaleadCloudview',
        'Excel\/',
        'Exploratodo',
        'ezooms',
        'facebookexternalhit',
        'facebookplatform',
        'fairshare',
        'Faraday v',
        'Faveeo',
        'Favicon downloader',
        'FavOrg',
        'Feed Wrangler',
        'Feedbin',
        'FeedBooster',
        'FeedBucket',
        'FeedBurner',
        'FeedChecker',
        'Feedfetcher-Google',
        'Feedly',
        'Feedspot',
        'FeedValidator',
        'feeltiptop',
        'Fetch API',
        'Fetch\/[0-9]',
        'Fever\/[0-9]',
        'findlink',
        'findthatfile',
        'Flamingo_SearchEngine',
        'FlipboardProxy',
        'FlipboardRSS',
        'fluffy',
        'flynxapp',
        'forensiq',
        'FoundSeoTool\/[0-9]',
        'free thumbnails',
        'FreeWebMonitoring SiteChecker',
        'Funnelback',
        'g00g1e\.net',
        'GAChecker',
        'geek-tools',
        'Genderanalyzer',
        'Genieo',
        'GentleSource',
        'GetLinkInfo',
        'getprismatic\.com',
        'GetURLInfo\/[0-9]',
        'GigablastOpenSource',
        'Go [\d\.]* package http',
        'Go-http-client',
        'GomezAgent',
        'gooblog',
        'Goodzer\/[0-9]',
        'Google favicon',
        'Google Keyword Suggestion',
        'Google Keyword Tool',
        'Google Page Speed Insights',
        'Google PP Default',
        'Google Search Console',
        'Google Web Preview',
        'Google-Adwords',
        'Google-Apps-Script',
        'Google-Calendar-Importer',
        'Google-HTTP-Java-Client',
        'Google-Publisher-Plugin',
        'Google-SearchByImage',
        'Google-Site-Verification',
        'Google-Structured-Data-Testing-Tool',
        'Google_Analytics_Snippet_Validator',
        'google_partner_monitoring',
        'GoogleHC\/',
        'GoogleProducer',
        '^Goose\/',
        'GoScraper',
        'GoSpotCheck',
        'GoSquared-Status-Checker',
        'gosquared-thumbnailer',
        'GotSiteMonitor',
        'Grammarly',
        'grouphigh',
        'grub-client',
        'GTmetrix',
        'Hatena',
        'hawkReader',
        'HEADMasterSEO',
        'HeartRails_Capture',
        'heritrix',
        'Holmes',
        'HostTracker',
        'ht:\/\/check',
        'htdig',
        'HTMLParser\/',
        'HTTP-Header-Abfrage',
        'http-kit',
        'HTTP-Tiny',
        'HTTP_Compression_Test',
        'http_request2',
        'http_requester',
        'HttpComponents',
        'httphr',
        'HTTPMon',
        'httpscheck',
        'httpssites_power',
        'httpunit',
        'HttpUrlConnection',
        'httrack',
        'huaweisymantec',
        'HubPages.*crawlingpolicy',
        'HubSpot Connect',
        'HubSpot Marketing Grader',
        'HyperZbozi.cz Feeder',
        'ichiro',
        'IdeelaborPlagiaat',
        'IDG Twitter Links Resolver',
        'IDwhois\/[0-9]',
        'Iframely',
        'igdeSpyder',
        'IlTrovatore',
        'ImageEngine\/',
        'ImageFetcher\/[0-9]',
        'InAGist',
        'inbound\.li parser',
        'InDesign%20CC',
        'infegy',
        'infohelfer',
        'InfoWizards Reciprocal Link System PRO',
        'inpwrd\.com',
        'Integrity',
        'integromedb',
        'InternetSeer',
        'internetVista monitor',
        'IODC',
        'IOI',
        'ips-agent',
        'ipv6-test.com validator',
        'iqdb\/',
        'Irokez',
        'isitup\.org',
        'iskanie',
        'iZSearch',
        'janforman',
        'Jigsaw',
        'Jobboerse',
        'jobo',
        'Jobrapido',
        'KeepRight OpenStreetMap Checker',
        'KimonoLabs\/',
        'knows\.is',
        'kouio',
        'KrOWLer',
        'kulturarw3',
        'KumKie',
        'L\.webis',
        'Larbin',
        'LayeredExtractor',
        'LibVLC',
        'libwww',
        'link checker',
        'Link Valet',
        'link validator',
        'linkCheck',
        'linkdex',
        'LinkExaminer',
        'linkfluence',
        'LinkTiger',
        'LinkWalker',
        'Lipperhey',
        'livedoor ScreenShot',
        'LoadImpactPageAnalyzer',
        'LoadImpactRload',
        'LongURL API',
        'looksystems\.net',
        'ltx71',
        'lwp-trivial',
        'lycos',
        'LYT\.SR',
        'mabontland',
        'MagpieRSS',
        'Mail.Ru',
        'MailChimp\.com',
        'Mandrill',
        'marketinggrader',
        'Mediapartners-Google',
        'MegaIndex\.ru',
        'Melvil Rawi\/',
        'MergeFlow-PageReader',
        'MetaInspector',
        'Metaspinner',
        'MetaURI',
        'Microsearch',
        'Microsoft Office ',
        'Microsoft Windows Network Diagnostics',
        'Mindjet',
        'Miniflux',
        '^Mget',
        'Mnogosearch',
        'mogimogi',
        'Mojolicious (Perl)',
        'monitis',
        'Monitority\/[0-9]',
        'montastic',
        'MonTools',
        'Moreover',
        'Morning Paper',
        'mowser',
        'Mrcgiguy',
        'mShots',
        'MVAClient',
        'nagios',
        'Najdi\.si\/',
        'NETCRAFT',
        'NetLyzer FastProbe',
        'netresearch',
        'NetShelter ContentScan',
        'NetTrack',
        'Netvibes',
        'Neustar WPM',
        'NeutrinoAPI',
        'NewsBlur .*(Fetcher|Finder)',
        'NewsGator',
        'newsme',
        'newspaper\/',
        'NG-Search',
        'nineconnections\.com',
        'NLNZ_IAHarvester',
        'node-superagent',
        'node\.io',
        'nominet\.org\.uk',
        'Notifixious',
        'notifyninja',
        'nuhk',
        'nutch',
        'Nuzzel',
        'nWormFeedFinder',
        'Nymesis',
        'Ocelli\/[0-9]',
        'oegp',
        'okhttp',
        'Omea Reader',
        'omgili',
        'Online Domain Tools',
        'OpenCalaisSemanticProxy',
        'Openstat\/',
        'OpenVAS',
        'Optimizer',
        'Orbiter',
        'ow\.ly',
        'ownCloud News',
        'Page Analyzer',
        'Page Valet',
        'page2rss',
        'page_verifier',
        'PagePeeker',
        'Pagespeed\/[0-9]',
        'Panopta',
        'panscient',
        'parsijoo',
        'PayPal IPN',
        'Pcore-HTTP',
        'Pearltrees',
        'peerindex',
        'Peew',
        'PhantomJS\/',
        'Photon\/',
        'phpcrawl',
        'phpservermon',
        'Pi-Monster',
        'Pingdom\.com',
        'PingSpot',
        'Pinterest',
        'Pizilla',
        'Ploetz \+ Zeller',
        'Plukkie',
        'PocketParser',
        'Pompos',
        'Port Monitor',
        'postano',
        'PostPost',
        'postrank',
        'Priceonomics Analysis Engine',
        'Prlog',
        'probethenet',
        'Project 25499',
        'Promotion_Tools_www.searchenginepromotionhelp.com',
        'prospectb2b',
        'Protopage',
        'proximic',
        'PTST ',
        'PTST\/[0-9]+',
        'Pulsepoint XT3 web scraper',
        'Python-httplib2',
        'python-requests',
        'Python-urllib',
        'Qirina Hurdler',
        'Qseero',
        'Qualidator.com SiteAnalyzer',
        'Quora Link Preview',
        'Qwantify',
        'Radian6',
        'RankSonicSiteAuditor',
        'Readability',
        'RealPlayer%20Downloader',
        'RebelMouse',
        'redback\/',
        'ReederForMac',
        'ResponseCodeTest\/[0-9]',
        'RestSharp',
        'RetrevoPageAnalyzer',
        'Riddler',
        'Rival IQ',
        '^RMA\/',
        'Robosourcer',
        'Robozilla\/[0-9]',
        'ROI Hunter',
        'SalesIntelligent',
        'SauceNAO',
        'SBIder',
        'Scoop',
        'scooter',
        'ScoutJet',
        'ScoutURLMonitor',
        'Scrapy',
        'Scrubby',
        '^scrutiny\/',
        'SD4M-fetcher',
        'SearchSight',
        'semanticdiscovery',
        'semanticjuice',
        'SEO Browser',
        'Seo Servis',
        'seo-nastroj.cz',
        'SEOCentro',
        'SeoCheck',
        'SEOstats',
        'Server Density Service Monitoring',
        'servernfo\.com',
        'Seznam screenshot-generator',
        'Shelob',
        'Shoppimon Analyzer',
        'ShopWiki',
        'ShortLinkTranslate',
        'SilverReader',
        'SimplePie',
        'SimplyFast',
        'Site-Shot\/',
        'Site24x7',
        'SiteBar',
        'SiteCondor',
        'siteexplorer\.info',
        'SiteGuardian',
        'Siteimprove\.com',
        'Sitemap(s)? Generator',
        'SiteTruth',
        'SkypeUriPreview',
        'slider\.com',
        'slurp',
        'SMRF URL Expander',
        'Snappy',
        'SniffRSS',
        'sniptracker',
        'SNK Siteshooter B0t',
        'Snoopy',
        'sogou web',
        'SortSite',
        'spaziodati',
        'Specificfeeds',
        'speedy',
        'SPEng',
        'Spinn3r',
        'spray-can',
        'Sprinklr ',
        'spyonweb',
        'Sqworm',
        'SSL Labs',
        'StackRambler',
        'Statastico\/',
        'StatusCake',
        'Stratagems Kumo',
        'Stroke.cz',
        'StudioFACA',
        'suchen',
        'summify',
        'Super Monitoring',
        'Surphace Scout',
        'SwiteScraper',
        'Symfony2 BrowserKit',
        'Sysomos',
        'Tarantula\/',
        'teoma',
        'terrainformatica\.com',
        'theinternetrules',
        'theoldreader\.com',
        'The Expert HTML Source Viewer',
        'Thumbshots',
        'ThumbSniper',
        'TinEye',
        'Tiny Tiny RSS',
        'touche.com',
        'Traackr.com',
        'truwoGPS',
        'tweetedtimes\.com',
        'Tweetminster',
        'Twikle',
        'Twingly',
        'Typhoeus',
        'ubermetrics-technologies',
        'uclassify',
        'UdmSearch',
        'UnwindFetchor',
        'updated',
        'Upflow',
        'URLChecker',
        'URLitor.com',
        'urlresolver',
        'Urlstat',
        'UrlTrends Ranking Updater',
        'Vagabondo',
        'Validator\.nu\/LV',
        'via ggpht\.com GoogleImageProxy',
        'visionutils',
        'vkShare',
        'voltron',
        'Vortex\/[0-9]',
        'voyager\/',
        'VSAgent\/[0-9]',
        'VSB-TUO\/[0-9]',
        'VYU2',
        'w3af\.org',
        'W3C-checklink',
        'W3C-mobileOK',
        'W3C_CSS_Validator_JFouffa',
        'W3C_I18n-Checker',
        'W3C_Unicorn',
        'W3C_Validator',
        'wangling',
        'Wappalyzer',
        'WatchMouse',
        'WbSrch\/',
        'web-capture\.net',
        'Web-Monitoring',
        'Web-sniffer',
        'Webauskunft',
        'WebCapture',
        'webcollage',
        'WebCookies',
        'WebCorp',
        'WebFetch',
        'WebImages',
        'WebIndex',
        'webkit2png',
        'webmastercoffee',
        'webmon ',
        'webnumbrFetcher',
        'weborama-fetcher',
        'webscreenie',
        'Webshot',
        'Website Analyzer\/',
        'websitepulse[+ ]checker',
        'Websnapr\/',
        'Websquash\.com',
        'WebThumbnail',
        'WeCrawlForThePeace',
        'WeLikeLinks',
        'WEPA',
        'WeSEE',
        'wf84',
        'wget',
        'WhatsApp',
        'WhatsMyIP',
        'WhatWeb',
        'Whibse',
        'Whynder Magnet',
        'Windows-RSS-Platform',
        'WinHttpRequest',
        'wkhtmlto',
        'wmtips',
        'Woko',
        'WomlpeFactory',
        'Word\/',
        'WordPress\/',
        'wotbox',
        'WP Engine Install Performance API',
        'WPScan',
        'wscheck',
        'WWW-Mechanize',
        'www\.monitor\.us',
        'XaxisSemanticsClassifier',
        'Xenu Link Sleuth',
        'XING-contenttabreceiver\/[0-9]',
        'XmlSitemapGenerator',
        'xpymep([0-9]?)\.exe',
        'Y!J-(ASR|BSC)',
        'Yaanb',
        'yacy',
        'Yahoo Ad monitoring',
        'Yahoo Link Preview',
        'Yahoo! Site Explorer Feed Validator',
        'YahooCacheSystem',
        'YahooSeeker',
        'YahooYSMcm',
        'YandeG',
        'yandex',
        'yanga',
        'yeti',
        'Yo-yo',
        'Yoleo Consumer',
        'yoogliFetchAgent',
        'YottaaMonitor',
        'yourls\.org',
        'Zao',
        'Zemanta Aggregator',
        'Zend\\\\Http\\\\Client',
        'Zend_Http_Client',
        'zgrab',
        'ZnajdzFoto',
        'ZyBorg',
        '[a-z0-9\-_]*((?<!cu)bot|crawler|archiver|transcoder|spider|uptime)',
    );
}
