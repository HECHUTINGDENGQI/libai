// JavaScript Document

$(document).ready(function() {
	
    var a = $(".down_left form input").val();
    
	var b =$(".down_left input").length;
	  console.log(b)
	  $(".down_left input:first-child").focus(function(){
		    var c=$(this).index()
			console.log(c);
			var d=$(".down_left input").eq(c).val();
			console.log(d)
            if($(".down_left input:first-child").val() == "名字："){
				$(".down_left input:first-child").val("")
			}
			
		  })
		   $(".down_left input:first-child+input").focus(function(){
		    var c=$(this).index()
			console.log(c);
			var d=$(".down_left input").eq(c).val();
			console.log(d)
             if($(".down_left input:first-child+input").val() == "电话："){
				 
				$(".down_left input:first-child+input").val("")
			}
			
		  })
		   $(".down_left input:first-child+input+input").focus(function(){
		    var c=$(this).index()
			console.log(c);
			var d=$(".down_left input").eq(c).val();
			console.log(d)
            
			 if($(".down_left input:first-child+input+input").val() == "邮箱："){
				$(".down_left input:first-child+input+input").val("")
			}
		  })
		   $(".down_left input:first-child+input+input+input").focus(function(){
		    var c=$(this).index()
			console.log(c);
			var d=$(".down_left input").eq(c).val();
			console.log(d)
            
			 if($(".down_left input:first-child+input+input+input").val() == "传真："){
				$(".down_left input:first-child+input+input+input").val("")
			}
		  })
			 
			 
	 $(".down_left input:first-child").blur(function(){
		     var c=$(this).index()
			console.log(c);
			var d=$(".down_left input").eq(c).val();
			if($(".down_left input:first-child").val() == ""){
				$(".down_left input:first-child").val("名字：")
			}
			 
		  })
		   $(".down_left input:first-child+input").blur(function(){
		     var c=$(this).index()
			console.log(c);
			
			if($(".down_left input:first-child+input").val() == ""){
				$(".down_left input:first-child+input").val("电话：")
			}
			 
		  })
		  $(".down_left input:first-child+input+input").blur(function(){
		     var c=$(this).index()
			console.log(c);
			var d=$(".down_left input").eq(c).val();
			
			 if($(".down_left input:first-child+input+input").val() == ""){
				$(".down_left input:first-child+input+input").val("邮箱：")
			}
		  })
			 $(".down_left input:first-child+input+input+input").blur(function(){
		     var c=$(this).index()
			console.log(c);
			var d=$(".down_left input").eq(c).val();
			
			 if($(".down_left input:first-child+input+input+input").val() == ""){
				$(".down_left input:first-child+input+input+input").val("传真：")
			}
		  })  
			 $(".down_left textarea").focus(function(){
				 var d=$(".down_left textarea").val()
				 console.log(d)
				 if($(".down_left textarea").val() == "地址:"){
					 
					 $(".down_left textarea").val("")
					 }
				 
				 
				 })
				 
				 $(".down_left textarea").blur(function(){
				  if($(".down_left textarea").val()==""){
					 
					 $(".down_left textarea").val("地址:")
					 }
				 
				 
				 })
				 
			 $(".down_right textarea").focus(function(){
				 var d=$(".down_right textarea").val()
				 console.log(d)
				 if($(".down_right textarea").val()=="留言:" ){
					 
					 $(".down_right textarea").val("")
					 }
				 
				 
				 })
				 
				 $(".down_right textarea").blur(function(){
				  if($(".down_right textarea").val()=="" ){
					 
					 $(".down_right textarea").val("留言：")
					 }
				 
				 
				 })
 
		   $(".down_right input").focus(function(){
		    var c=$(this).index()
			console.log(c);
			var d=$(".down_right input").val();
			console.log(d)
                  if($(".down_right input").val() == "输入验证码"){
				$(".down_right input").val("")
				  }
		  })
		  
		  $(".down_right input").blur(function(){
		     var c=$(this).index()
			console.log(c);
			var d=$(".down_right input").val();
		
			if($(".down_right input").val() == ""){
			$(".down_right input").val("输入验证码")
			}
			
			
		 })	  
	  
});


