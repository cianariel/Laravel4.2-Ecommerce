<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) 
{ 
die('Direct Access not permitted...'); 
}


?>

<span id="pluginDir" style="display:none;"><?php echo plugin_dir_url(__FILE__); ?></span>
<span id="ppsMainAccKey" style="display:none;"><?php echo @get_option("prepostseo_acckey"); ?></span>
<span id="ppsPluginVersion" style="display:none;"><?php echo @get_option("prepostseo_version"); ?></span>
<span id="ppsAdminURL" style="display:none;"><?php echo get_admin_url(); ?></span>
<span id="ppsSiteURL" style="display:none;"><?php echo esc_url( home_url( '/' ) ); ?></span>

<div class="pps_seo_box">
	
    <span class="sec_heading" style=" display:none;">SEO Score</span>

    <table style="margin:20px 0; width:100%; display:none;" >
        <tr>
            <td width="80%" valign="top">
                
                <span style="margin-top:30px; float:left;">
                    <span class="bar_btn">Passed:</span>
                    <span class="outer_bar">
                        <span class="inner_green" id="greenBar" start="0" style="width:0%;"></span>
                    </span>
                </span>
                <br><br>
                <span style="margin-top:17px; float:left;">
                    <span class="bar_btn">To Improve:</span>
                    <span class="outer_bar">
                        <span class="inner_yellow" id="yellowBar" start="0" style="width:0%;"></span>
                    </span>
                </span>
                <br><br>
                <span style="margin-top:17px; float:left;">
                    <span class="bar_btn">Error:</span>
                    <span class="outer_bar">
                        <span class="inner_red"  id="redBar" start="0" style="width:0%;"></span>
                    </span>
                </span>
            </td>
            <td width="20%">
                 <div id="pbar" class="progress-pie-chart" data-percent="0">
                    <div class="ppc-progress">
                        <div class="ppc-progress-fill" style="transform: rotate(0deg);"></div>
                    </div>
                    <div class="ppc-percents">
                        <div class="pcc-percents-wrapper">
                            <span class="score">0</span>
        
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
            
	<span class="sec_heading">Your Blog SEO Details</span>
	<span class="row">
    	<p style="padding:10px; font-size:14px;">
        	Check your blog seo with just one click. this SEO report will check meta title, meta description, links used in 
            your website and status of those links, check either links are seo friendly or not, check underscores in your links.
            <br>
            Also some advance tools are used in this section to check the keywords used in your website. There is a section that will 
            inform you that about the keywords uasge in your meta title and meta description.
            <br>
            
        </p>
    </span>
    <span class="row" id="loadingSec" style="text-align:center !important; display:none; margin-bottom:30px;">
    	<i class="fa fa-refresh fa-spin" style="font-size:72px; color:#027386;"></i> <br>
        Please Wait! Loading Website Details..... <br>
    </span>
    <span class="row" id="infoSec">
    	
        <p style="text-align:center;">
        <?php if ( ! defined( 'PPS_APIKEY' ) ): ?>
        	<span class="red">Looks like you have not created your account API Key yet.</span> <br>
            Please create an account at <a href="http://www.prepostseo.com">prepostseo.com</a> and get your API key.
            Then put and save API key in the plugin <a href="<?php echo get_admin_url(); ?>admin.php?page=prepost-seo">setting page</a>
        <?php else: ?>
        <span class="genrateBtn" id="checkSiteSEO">
        	<i class="fa fa-compass"></i> Check Blog SEO
        </span>
        <?php endif; ?>
        </p>
        
    </span>
    <span class="row" id="reportDetails" style="display:none;">
    <span class="sec_heading">Seo Report</span>
	<table class="pps_seo_table pps_st" id="pps-site-seo">
    	
		<?php /*
        <tr>
        	<td width="20%">
            	Title Tag
            </td>
            <td width="7%">
            	<i class="fa fa-check fa-2x green"></i>
            </td>
            <td width="83%">
            	The meta title length of your page is 47 characters. Most search engines will truncate Page title to 65 characters.
                <div class="more_info">
                	<i class="arrow_r fa fa-arrow-right"></i>Kick Exam - Clear Your Exams Easily
                </div>
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	Meta Description
            </td>
            <td>
            	<i class="fa fa-warning fa-2x icon_cross_light icon_size"></i>
            </td>
            <td>
            	The meta description length of your page is 147 characters. Most search engines will truncate meta descriptions to 160 characters.
                <div class="more_info">
                	
                	<i class="arrow_r fa fa-arrow-right"></i>
                    Download Upwork Skill Test Dumps include All Questions and answers. Pass exams with TOP 1%, 5% or 10% position and get high levels Expert / Master.
                	
                </div>
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	Google Search Results Preview
            </td>
            <td>
            	<i class="fa fa-info-circle fa-2x icon_info"></i>
            </td>
            <td>
            	<div class="google-preview">
                	<span class="title">Kick Exam - Clear Your Exams Easily</span>
                    <span class="final-url">http://kickexam.com</span>
                    <span class="description">Download Upwork Skill Test Dumps include All Questions and answers. Pass exams with TOP 1%, 5% or 10% positions</span>
                </div>
                
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	Keywords Test
            </td>
            <td>
            	<i class="fa fa-info-circle fa-2x icon_info"></i>
            </td>
            <td>
            	There is likely no optimal keyword density (search engine algorithms have evolved beyond keyword density metrics as a significant ranking factor). It can be useful, however, to note which keywords appear most often in your page, and if they reflect the intended topic of your page. More importantly, the keywords in your page should appear within natural sounding and grammatically correct copy.
                
                <div class="more_info">
                	<i class="arrow_r fa fa-arrow-right"></i> Test - 25 Times<br>
                    <i class="arrow_r fa fa-arrow-right"></i> Test - 20 Times<br>
                    <i class="arrow_r fa fa-arrow-right"></i> Test - 17 Times<br>
                    <i class="arrow_r fa fa-arrow-right"></i> Test - 15 Times<br>
                    <i class="arrow_r fa fa-arrow-right"></i> Test - 14 Times
                </div>
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	Keywords Usage
            </td>
            <td>
            	<i class="fa fa-info-circle fa-2x icon_info"></i>
            </td>
            <td>
            	Your most common keywords are not appearing in one or more of the meta-tags above. Your primary keywords should appear in your meta-tags to help identify the topic of your webpage to search engines.
                <div class="more_info">
                	<i class="icon_cross fa fa-remove"></i> Keyword(s) not included in Meta-Title <br>
                    <i class="green fa fa-check"></i> Keyword(s) included in Meta-Description <br>
                </div>
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	&lt;h1&gt; Headings Status
            </td>
            <td>
            	<i class="fa fa-check fa-2x green"></i>
            </td>
            <td>
            	Your page contains H1 headings. Their contents are listed below:
                <div class="more_info">
                	<i class="arrow_r fa fa-arrow-right"></i> keywords are not appearing in one or more
                </div>
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	&lt;h2&gt; Headings Status
            </td>
            <td>
            	<i class="fa fa-check fa-2x green"></i>
            </td>
            <td>
            	Your page contains H2 headings. Their contents are listed below:
                <div class="more_info">
                	<i class="arrow_r fa fa-arrow-right"></i> keywords are not appearing in one or more
                </div>
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	Robots.txt Test
            </td>
            <td>
            	<i class="fa fa-check fa-2x green"></i>
            </td>
            <td>
            	Congratulations! Your site use a "robots.txt" file: <a href="#">http://www.kickexam.com/robots.txt</a>
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	Broken Links Test
            </td>
            <td>
            	<i class="fa fa-warning fa-2x icon_cross_light icon_size"></i>
            </td>
            <td>
            	From 43 distinct anchor links analyzed, none of them appears to be broken.
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	Sitemap Test
            </td>
            <td>
            	  <i class="fa fa-remove fa-2x icon_cross"></i>
                
            </td>
            <td>
            	Congratulations! We've found 3 sitemaps files for your website:
                <div class="more_info">
                	<i class="arrow_r fa fa-arrow-right"></i> <a href="#">http://www.kickexam.com/stemap.xml</a> <br>
                    <i class="arrow_r fa fa-arrow-right"></i> <a href="#">http://www.kickexam.com/stemap2.xml</a>
                </div>
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	Underscores in Links Test
            </td>
            <td>
            	<i class="fa fa-check fa-2x green"></i>
            </td>
            <td>
            	Congratulations! We have not found underscores in your in-page URLs!
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	Image Alt Test
            </td>
            <td>
            	<i class="fa fa-warning fa-2x icon_cross_light"></i>
            </td>
            <td>
            	Your webpage has 44 'img' tags and 2 of them are missing the required 'alt' attribute. Details Below
                <div class="more_info">
                	<i class="arrow_r fa fa-arrow-right"></i>http://www.kickexam.com/stemap.xml<br>
                    <i class="arrow_r fa fa-arrow-right"></i>http://www.kickexam.com/stemap2.xml
                </div>
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	Inline CSS Test
            </td>
            <td>
            	<i class="fa fa-warning fa-2x icon_cross_light"></i>
            </td>
            <td>
            	Your webpage is using 178 inline CSS styles!
                <div class="more_info">
                	<i class="arrow_r fa fa-arrow-right"></i>http://www.kickexam.com/stemap.xml<br>

                    <i class="arrow_r fa fa-arrow-right"></i>http://www.kickexam.com/stemap2.xml
                </div>
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	Deprecated HTML Tags
            </td>
            <td>
            	<i class="fa fa-check fa-2x green"></i>
            </td>
            <td>
            	Congratulations! Your page does not use HTML deprecated tags.
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	Google Analytics Test
            </td>
            <td>
            	<i class="fa fa-check fa-2x green"></i>
            </td>
            <td>
            	Congratulations! Your website is using the asynchronous version of Google Analytics tracking code.
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	Favicon Test
            </td>
            <td>
            	<i class="fa fa-check fa-2x green"></i>
            </td>
            <td>
            	Congratulations! Your website appears to have a favicon.
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	SEO Friendly URL Test
            </td>
            <td>
            	<i class="fa fa-check fa-2x green"></i>
            </td>
            <td>
            	Congratulations! This URL and all internal links on this page are SEO friendly.
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	Social Media Check
            </td>
            <td>
            	<span class="fa-stack fa-lg icon_cross">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-remove fa-stack-1x fa-inverse"></i>
                </span>
            </td>
            <td>
            	Your website is not connected with social media using the API's provided by Facebook, Google +, Twitter, Pinterest, etc
            </td>
        </tr>
        <tr class="details_tr">
        	<td>
            	Social Media Activity
            </td>
            <td>
            	<span class="fa-stack fa-lg icon_cross">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-remove fa-stack-1x fa-inverse"></i>
                </span>
            </td>
            <td>
            	Your website doesn't have any social media activity. Search engines are increasingly using social media activity as an indicator of site credibility, and to determine which sites are relevant for a given keyword search.
            </td>
        </tr>
		*/ ?>
        
    </table>
    </span>
</div>	

