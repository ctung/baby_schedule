<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="js/bootstrap-clockpicker.min.js"></script>
<script src="js/nouislider.min.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script>
 $(document).on('click', '.delete-btn', function(){
     if(confirm('Are you sure?')) {
	 var eid = $(this).closest('td').find('.eid').text();
	 $("#eid").val(eid);
	 $(this).closest('form').submit();
     }
 });
</script>
		     
