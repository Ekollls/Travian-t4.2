<script type="text/javascript">
  function changeLanguage(){
		var sellang = document.getElementById('sellang');
		var p = sellang.options[sellang.selectedIndex].value;
		location.assign('setlang.php?setlang='+p);
	}
</script>