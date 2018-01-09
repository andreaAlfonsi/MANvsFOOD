	</main>
	<footer>
		<p>Developed by Andrea Alfonsi and Matteo Esposto </br> @<?php echo date("Y"); ?> </p>
	</footer>
	</div>
		<script>
			function responsiveNav() {
				var x = document.getElementById("myTopnav");
				if (x.className === "topnav") {
					x.className += " responsive";
				} else {
					x.className = "topnav";
				}
			}
		</script>
	</body>
</html>