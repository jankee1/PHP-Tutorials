(self.webpackChunksymfony_4_and_5_practice_app=self.webpackChunksymfony_4_and_5_practice_app||[]).push([[310],{154:()=>{$(document).ready((function(){$(".userLikesVideo").show(),$(".userDoesNotLikeVideo").show(),$(".noActionYet").show(),$(".toogle-likes").on("click",(function(i){i.preventDefault();var e=$(i.currentTarget);$.ajax({method:"POST",url:e.attr("href")}).done((function(i){switch(i.action){case"liked":var e=$(".number-of-likes-"+i.id),d=parseInt(e.html().replace(/\D/g,""))+1;e.html("("+d+")"),$(".likes-video-id-"+i.id).show(),$(".dislikes-video-id-"+i.id).hide(),$(".video-id-"+i.id).hide();break;case"disliked":var s=$(".number-of-dislikes-"+i.id),o=parseInt(s.html().replace(/\D/g,""))+1;s.html("("+o+")"),$(".dislikes-video-id-"+i.id).show(),$(".likes-video-id-"+i.id).hide(),$(".video-id-"+i.id).hide();break;case"undo liked":e=$(".number-of-likes-"+i.id),d=parseInt(e.html().replace(/\D/g,""))-1;e.html("("+d+")"),$(".video-id-"+i.id).show(),$(".dislikes-video-id-"+i.id).hide(),$(".likes-video-id-"+i.id).hide();break;case"undo disliked":s=$(".number-of-dislikes-"+i.id),o=parseInt(s.html().replace(/\D/g,""))-1;s.html("("+o+")"),$(".video-id-"+i.id).show(),$(".dislikes-video-id-"+i.id).hide(),$(".likes-video-id-"+i.id).hide()}}))}))}))}},i=>{"use strict";var e;e=154,i(i.s=e)}]);