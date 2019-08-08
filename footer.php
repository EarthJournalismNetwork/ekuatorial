	</section><!-- #main-content -->
<footer id="colophon">
	<ul class="nav clearfix">
		<!-- <li class="label by">Project by</li> -->
		<!--<li class="label supported">Supported by</li> -->
		<li><a class="icon ejn" href="http://earthjournalism.net/" target="_blank">Earth Journalism Network</a></li>
		<li><a class="icon internews" href="http://www.internews.org" target="_blank">Internews</a></li>
		<li><a class="icon third" href="http://www.thethirdpole.net/" target="_blank">The Third Pole</a></li>
	</ul>
</footer>
<?php wp_footer(); ?>
</body>
<?php if (is_front_page()) : ?>
<!-- Typeform Widget -->
<a class="typeform-share button" href="https://clara7.typeform.com/to/wvr6xU" data-mode="1" target="_blank" style="display: none;">Launch Ekuatorial Homepage Survey</a>
<script>
(function(){var qs,js,q,s,d=document,gi=d.getElementById,ce=d.createElement,gt=d.getElementsByTagName,id='typef_orm',b='https://s3-eu-west-1.amazonaws.com/share.typeform.com/';if(!gi.call(d,id)){js=ce.call(d,'script');js.id=id;js.src=b+'share.js';q=gt.call(d,'script')[0];q.parentNode.insertBefore(js,q)}id=id+'_';if(!gi.call(d,id)){qs=ce.call(d,'link');qs.rel='stylesheet';qs.id=id;qs.href=b+'share-button.css';s=gt.call(d,'head')[0];s.appendChild(qs,s)}})();

function createCookie(name,value,days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else var expires = "";
  document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}

function eraseCookie(name) {
  createCookie(name,"",-1);
}

// Launch the survey after 10 seconds
setTimeout(function() {
  if (!readCookie('homepage_survey')){
    $('.typeform-share').trigger('click');
    createCookie('homepage_survey', 'filled', 180);
  }
}, 5000);
</script>
<?php endif; ?>
</html>
