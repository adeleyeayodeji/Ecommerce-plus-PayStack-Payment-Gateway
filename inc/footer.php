<!-- ========================= FOOTER ========================= -->
<footer class="section-footer bg-secondary text-white">
	<div class="container">
		<section class="footer-bottom text-center">
			<p class="text-white">Privacy Policy - Terms of Use - User Information Legal Enquiry Guide</p>
			<p class="text-muted"> &copy; 2020 Adeleye Ayodeji Inc., All rights reserved </p>
			<br>
	</section>
	</div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->
<script type="text/javascript">
	//Image preview
	function imagepreview(event, id) {
		var reader = new FileReader();

		reader.onload = function () {
			if (reader.readyState == 2) {
				$("#"+id).css({
					"background" : "url("+reader.result+")",
					"background-position" : "center top",
					"background-size" : "cover",
					"background-repeat" : "no-repeat",
					"border" : "3px solid black",
				});
				// console.log(reader.result);
			}
		}
		reader.readAsDataURL(event.target.files[0]);

	}
</script>
</body>
</html>