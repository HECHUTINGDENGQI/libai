	$(document).ready(function(){
		var liLen = $(".banner ul li").length; //.length:获取li的长度（个数）
		var num = 0;
	
		$(".banner ul li").eq(0).show().siblings().hide();/*eq(i):获取索引值为i的元素;show():显示元素;siblings():获取兄弟元素;hide():隐藏元素*/
		$(".point ul li").eq(0).addClass("on");/*addClass():添加class*/
		$(".point ul li").click(function(){
			
			
			var a = $(this).index();/*$(this):获取当前元素;index():获取索引值*/
			console.log(a)
			$(this).addClass("on").siblings().removeClass("on");
			$(".banner ul li").eq(a).show().siblings().hide();
			return num = a;
			console.log(a);
			})
			
		function show(){  /*function 函数名(){}:封装函数*/
			num+=1;  //num = num+1
			if(num>=liLen){   /*if(){}:if判读语句*/
				num = 0;
				}
			$(".banner ul li").eq(num).show().siblings().hide();
			$(".point ul li").eq(num).addClass("on").siblings().removeClass("on");	
			
			}
			var lun = setInterval(function(){  /*setInterval():定义定时器*/
				show();
				},1000)
			
			$(".slider").mouseover(function(){  /*mouseover():鼠标经过事件*/
				clearInterval(lun)  /*clearInterval():清除定时器*/
				})
			
			$(".slider").mouseout(function(){   /*mouseout():鼠标离开事件*/
				lun= setInterval(function(){
				show();
				},1000)
				})
				
			$(".next").click(function(){
				show();
			})
			
			$(".prev").click(function(){
				num-=1;
				if(num<0){
					num = liLen-1;
					}
				$(".banner ul li").eq(num).show().siblings().hide();
				$(".point ul li").eq(num).addClass("on").siblings().removeClass("on");	
				})
		})

 