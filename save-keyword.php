<style type="text/css">
	*{
		padding: 0;
		margin: 0;
	}

	body{
		font-family: sans-serif;
	}

	.rel{
		position: relative;
	}

	.dropdown{
		position: absolute;
		top: 30px;
		left: 0;
		right: 0;
	}

	input{
		height: 30px;
	}

	.sbab{
		float: right;
	}

	.keywordDel{
		cursor: pointer;
	}

	.clear {
	  clear: both;
	  display: block;
	  overflow: hidden;
	  visibility: hidden;
	  width: 0;
	  height: 0;
	}
</style>
<form id="search" action="save-keyword.php" method="post" class="rel">
	<div>
		<input type="text" id="keyword" name="keyword" />
		<input type="submit" value="搜尋" id="submit">
	</div>
	<div class="dropdown">
		<div class="dropdownWrap">
		</div>
	</div> <!-- /dropdown -->
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script type="text/javascript">
	$(function(){
		var COOKIE_NAME = "ilovebaby_keyword";
   
        if($.cookie(COOKIE_NAME)){  
        	var myArray = JSON.parse($.cookie(COOKIE_NAME));
			getItemList(COOKIE_NAME,myArray);
		}else{
			var myArray = [];
		}

		$("#submit").on('click', function(event) {
			// event.preventDefault();
			var len = myArray.length;
			myArray[len] = $("#keyword").val();
        	
        	saveToCookie(COOKIE_NAME,myArray);
		});

		$(document).on('click', '.keywordDel', function(event) {
			event.preventDefault();
			
			var removeItem = $(this).parents(".item").find('.word').html();
			var i = $.inArray(removeItem, myArray);

			if(i > 0){
				myArray.splice($.inArray(removeItem, myArray),1);
        		saveToCookie(COOKIE_NAME,myArray);

        		//refresh
        		$(".dropdownWrap").html('');
        		getItemList(COOKIE_NAME,myArray);
			}
		});
	})

	function saveToCookie(COOKIE_NAME,arr){
        var json_string = JSON.stringify(arr);
		$.cookie(COOKIE_NAME, json_string , { path: '/', expires: 10 });  
	}

	function getItemList(COOKIE_NAME,arr){
		$.each(arr, function(key,value) {
		  // console.log( key + ": " + value );

		  var selectItem = '<div class="item">' + 
			'<span class="word">' + value + '</span>' +
			'<div class="sbab">' + 
			'	<div class="keywordDel">X</div>' + 
			'	</div>' + 
			'	<hr class="clear">' + 
			'	</div>';
		  $(".dropdownWrap").append(selectItem);

		});
	}
</script>
