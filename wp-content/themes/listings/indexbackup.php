<?php get_header(); ?>
<?php global $woo_options; ?>
  <div id="content" class="col-full home-content">
    <div class="full">
      <ul class='kwicks kwicks-vertical'>
         <li>
	   <ul class='kwicks kwicks-horizontal'>
	     <li id="book">
	       <h2>Book Hotels Online or By Phone</h2>
               <h3>0118 971 4700</br>
             	Exclusive Phone Only SECRET Deals</br>
               	Specialists in Conference & Event Bookings</br>
               	Chat Online or Call Us for Expert Advice</h3>
               <a class="image-link" href="//essentialhotels.co.uk"><img width="500" height="300" alt="" src="//essentialhotels.co.uk/wp-content/uploads/2014/05/Book-Online-Slide.jpg" /></a>
             </li>
             <li id="special">
               <h2>Destinations</h2>
               <a class="image-link" href="//essentialhotels.co.uk/destinations/"><img width="500" height="300" alt="" src="//essentialhotels.co.uk/wp-content/uploads/2014/05/Destinations.jpg" /></a>
	       <div class="ticker"></div>
             </li>
             <li id="scottish">
               <h2>Hotel Collections</h2>
               <a class="image-link" href="//essentialhotels.co.uk/collections/"><img width="500" height="300" alt="" src="//essentialhotels.co.uk/wp-content/uploads/2014/05/Hotel-Collections.jpg" /></a>
	       <div class="ticker"></div>
             </li>
           </ul>
         </li>
         <li>
           <ul class='kwicks kwicks-horizontal'>
             <li id="beachside"> 
               <h2>Attractions</h2>                
               <a class="image-link" href="//essentialhotels.co.uk/attractions/"><img width="500" height="300" alt="" src="//essentialhotels.co.uk/wp-content/uploads/2014/05/Attractions.jpg" /></a>
               <div class="ticker"></div>
               </li>
               <li id="newforest">
               <h2>Top 10s</h2>
               <a class="image-link" href="//magazine.essentialhotels.co.uk/category/essentialtop10s//"><img width="500" height="300" alt="" src="//essentialhotels.co.uk/wp-content/uploads/2014/05/Top-Tens.jpg" /></a>
               <div class="ticker"></div>
               </li>
               <li id="magazine">
               <h2>Essential Magazine</h2>
               <h3>Latest in Travel News</br>
			                	Hotel Reviews & Interviews</br>
			                	Destination Guides</br>
			                	Events</br>
			                	Travel Tech</br>
			                	and more...</h3>
			                    <a class="image-link" href="//magazine.essentialworld.travel"><img width="500" height="300" alt="" src="//essentialhotels.co.uk/wp-content/uploads/2014/01/Essential-Hotel-Magazine-Header-Without-Text.jpg" /></a>
			                    <div class="ticker"></div>
			                </li>
			            </ul>
			        </li>	        
			    </ul>
			</div>		      

	<div id="main" class="fullwidth">      
<div id="MiddleWrapper">
    <div id="Search" div class="topbox">
		<div id="MiddleTitle">Search for Hotels, Guides and Articles</div>
			<form method="get" class="searchform" action="/">
				<div id="SearchFormHome" class="typeahead" >	
					<input type="text" class='s tt-input' size="18" value="" placeholder="Hotel, City, Area or Interest"  name="s" style="width:200px" />
					<input type="submit" class="submit button right" value="GO" />
				</div>
			</form>
		</div>
    
   	<div id="ContactUs" div class="topbox">
		<div style="font-size:38px; margin-top:30px; margin-left:25px; align:middle;">0118 971 4700</div>
		<a href="/contactus"><IMG style="margin-left:10px; margin-top:30px;" SRC="//essentialhotels.co.uk/wp-content/uploads/2013/12/gmail.png" ALT="Email"></a>
		<a href="https://www.facebook.com/EssentialHotels"><IMG style="margin-left:2px" SRC="//essentialhotels.co.uk/wp-content/uploads/2013/12/facebook.png" ALT="Facebook"></a>
		<a href="//www.twitter.com/EssentialHotels"><IMG style="margin-left:2px" SRC="//essentialhotels.co.uk/wp-content/uploads/2013/12/twitter.png" ALT="Twitter"></a>
		<a href="https://plus.google.com/101363488890050504768"><IMG style="margin-left:2px" SRC="//essentialhotels.co.uk/wp-content/uploads/2013/12/google+.png" ALT="Google Plus"></a>
  	</div>
	<div id="Newsletter" div class="topbox">
      	<div id="MiddleTitle">Signup for Offers</div>
		<!-- Begin MailChimp Signup Form -->
		
			<link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">
			<style type="text/css">
				#mc_embed_signup{background:#fff; clear:left; font:14px Roboto,Helvetica,Arial,sans-serif; }
				/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
				   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
			</style>
			<div id="mc_embed_signup">
			<form action="//e-travelguide.us2.list-manage.com/subscribe/post?u=592eb542ca8673e721a2788e2&amp;id=662743fbb3" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
			<div class="mc-field-group">
				
				<label for="mce-EMAIL">
			</label>
				
				<input type="email" value="example@email.com" onblur="if(this.value == '') { this.value='example@email.com'}" onfocus="if (this.value == 'example@email.com') {this.value=''}" name="EMAIL" class="required email" id="mce-EMAIL">
			</div>
				<div id="mce-responses" class="clear">
					<div class="response" id="mce-error-response" style="display:none"></div>
					<div class="response" id="mce-success-response" style="display:none"></div>
				</div>	<div><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="submit button" class="btn"></div>
			</form>
			</div>
		<!--End mc_embed_signup-->
		
    </div>
</div>	

		<div div id="boxbottom">
			<?php
				global $acn;
				echo $acn->show('taxonomy=region&sort=no&options=no&layout=grid&social=no'); 
			?>
			
		</div>
	
		<!--	
	<?php get_template_part('includes/tabbed-panel'); ?>
      -->
      
		</div>
		
    </div>
<?php get_footer(); ?>
