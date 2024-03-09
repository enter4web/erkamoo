	</div>
	
	<script type="text/javascript">

	$(document).ready(function(){
		$("[data-include]").each(function () {                
            $(this).load($(this).attr("data-include"));
        });
	});
	</script>
</body>
</html>
