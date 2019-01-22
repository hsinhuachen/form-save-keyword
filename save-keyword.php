<link href="http://newsite.ilovebaby.com.tw/assets/js/bootstrap/mingbootstrap-theme.min.css" rel="stylesheet">
<link href="http://newsite.ilovebaby.com.tw/assets/js/bootstrap/mingbootstrap.min.css" rel="stylesheet">
<link href="http://newsite.ilovebaby.com.tw/assets/css/ilovebaby.css" rel="stylesheet">
<style type="text/css">
	.rel{
		position: relative;
	}

	.dropdown{
		position: absolute;
		top: 40px;
		left: 0;
		right: 0;
		padding-left: 10px;
		padding-right: 10px;
		border-bottom-right-radius: 50px;
	    border-bottom-left-radius: 50px;
	    border-radius: 0px;
	    background: #FFFFFF;
	}

	.sbab{
		float: right;
	}

	.keywordDel{
		cursor: pointer;
	}

	.item span{
		font-size: 15px;
	}

	.clear {
	  clear: both;
	  display: block;
	  overflow: hidden;
	  visibility: hidden;
	  width: 0;
	  height: 0;
	  margin: 0;
	}
</style>
<section class="navblock">
	<form action="" method="get" name="searchbanner" id="searchbanner">
		<div class="searchBar rel" style="display: block">
		    <div class="searchBarBox">
		        <input id="skey" name="skey" type="text" onkeyup="value=value.replace(/&amp;/g,'')" onfocus="this.value=''" placeholder="請輸入關鍵字...">
		        <input name="imageField" type="image" src="https://newsite.ilovebaby.com.tw/templates/new/images/search.gif" border="0" style="visibility: hidden;">
		        <button><img src="https://newsite.ilovebaby.com.tw/assets/images/icon_searchGrey.png"></button>
		    </div>
		    <div class="dropdown hide">
				<div class="dropdownWrap">
				</div>
			</div>  <!-- /dropdown -->
		</div> <!-- /searchbar -->
	</form>
</section>

<!-- <form id="search" action="save-keyword.php" method="post" class="rel">
	<div>
		<input type="text" id="keyword" name="keyword" />
		<input type="submit" value="搜尋" id="submit">
	</div>
	<div class="dropdown hide">
		<div class="dropdownWrap">
		</div>
	</div> 
</form> -->
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

		$("#skey").on('click', function(event) {
			event.preventDefault();
			
			$(".dropdown").removeClass('hide');
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
