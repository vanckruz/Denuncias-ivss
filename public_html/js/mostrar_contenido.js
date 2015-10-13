// JavaScript Document
$(document).ready(function()
			{
				$("#denuncia").each(function()
				{
					var href = $(this).attr("href");
				  	$(this).attr({ href: "#"});
				  	$(this).click(function(){$("#contenidos").load(href);
				});
			     })});