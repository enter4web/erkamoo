		<footer class="main-footer">
			<div class="pull-right hidden-xs"><b>Version</b> <?php echo $param[5]->param_value;?></div>
			<?php echo $param[6]->param_value;?>
		</footer>
		
    </div>
	
	<script type="text/javascript">

	$(function () {
		$("[data-include]").each(function () {                
            $(this).load($(this).attr("data-include"));
        });
	});
	</script>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151214892-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-151214892-1');
	</script>-->

	<!-- Google Analytics -->
	<!--<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-151214892-1', 'auto');
	ga('send', 'pageview');
	</script>-->
</body>
</html>
