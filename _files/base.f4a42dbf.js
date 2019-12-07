/*! ©moviesrv 1.0.0 */
$.localStorage=function(){return window.localStorage||{_getData:function(){var a,b=document.createElement("input");return b.type="hidden",b.style.display="none",b.addBehavior("#default#userData"),document.body.appendChild(b),a=new Date,a.setDate(a.getDate()+365),b.expires=a.toUTCString(),this._getData=function(){return b},b},name:"userData",_decode:function(a){return a.replace(/[\/%]/g,"")},setItem:function(a,b){a=this._decode(a);var c=this,d=c._getData();d.load(c.name),d.setAttribute(a,b),d.save(c.name)},getItem:function(a){a=this._decode(a);var b=this._getData();return b.load(this.name),b.getAttribute(a)},removeItem:function(a){a=this._decode(a);var b=this,c=b._getData();c.load(b.name),c.removeAttribute(a),c.save(b.name)}}}(),$(function(){var a,b,c,d=window,e=$(d),f=$("body"),g=$.browser.msie&&$.browser.version<7,h=d.Popup={create:function(){$("#popup")[0]||f.append('<div id="popup"></div>'),$("#mask")[0]||f.append('<div id="mask"></div>'),a=$("#popup"),b=$("#mask"),h.attach(),h.create=function(){}},attach:function(){f.on("click",".J_ClosePopup",h.hide),b.click(h.hide),e.resize(h.alignMiddle)},hide:function(){return a&&a.size()&&(a.hide(),b.hide()),!1},alignMiddle:function(){a.is(":hidden")||(a.css({left:(e.width()-a.width())/2+"px",top:(e.height()-a.height())/2+"px"}),g&&(a.css("top",d.parseInt(a.css("top"),10)+e.scrollTop()+"px"),b.css("height",f.height()+"px")))},show:function(c){h.create(),a.html(c).show(),b.show(),h.alignMiddle()},templateShow:function(a,b){"undefined"==typeof b&&(b=a,a=$("#popup-template").html()),b.btn||(b.btn='<span class="btn btn-normal J_ClosePopup">确定</span>');var c=a.replace(/{(\w+)}/g,function(a,c){return b[c]||""});h.show(c)},getButton:function(a){for(var b=0,c=a.length,d=[];c>b;++b)d.push('<a href="',a[b].linkUrl,'" class="btn',b>0?"":" btn-normal",a[b].linkUrl?"":" J_ClosePopup",'">',a[b].prompt,"</a>");return d.join("")}},i=d.Tooltip={create:function(){$("#tooltip")[0]||f.append('<div id="tooltip"><i class="tri"></i><s class="tri"></s><p></p></div>'),c=$("#tooltip"),i.create=function(){}},show:function(a,b){d.clearTimeout(i.timer),a=$(a).eq(0);var e=a.offset();i.create(),c.find("p").html(b),c.show().css({top:e.top-c.outerHeight()-5+"px",left:e.left-c.outerWidth()/2+a.outerWidth()/2+"px"})},hide:function(){c&&c.size()&&c.hide()}},j=d.Seat={data:{seatNum:0,seats:[],seatTypes:[],seatsNo:[]},attach:function(){$("#J_SeatInfo").on("mouseover",".seat",function(){return i.hide(),!1}).on("click",".seat",function(){var a=$(this),b=a.data("type"),c=j.data.seatNum;if(a.hasClass("selected"))return 1>c?(h.templateShow({msg:"未知错误，请刷新重试",btn:'<a href="javascript:window.location.reload();" class="btn">确定</a>'}),!1):("L"===b||"R"===b?(j.cancel(a),j.cancel("L"===b?a.next():a.prev())):"N"===b&&j.cancel(a),!1);if(!/^[LRN]$/.test(b))return!1;if(!a.hasClass("selected"))return c>4?(h.templateShow({msg:"未知错误，请刷新重试",btn:'<a href="javascript:window.location.reload();" class="btn">确定</a>'}),!1):j.data.sectionId&&j.data.sectionId!==a.parents(".seat-item").data("sectionid")?(i.show(a,"只可以选同一场区座位"),!1):(4===c?i.show(a,"一次最多选择4个座位"):"L"===b||"R"===b?3===c?i.show(a,"此处为情侣座，您需要至少删除一个座位才可以选择"):(j.choose(a),j.choose("L"===b?a.next():a.prev())):"N"===b&&j.choose(a),!1)}),$(d.document.forms.chooseForm).submit(function(a){function b(){var a=$.extend({},f);a.seats=a.seats.join("|"),a.seatsNo=a.seatsNo.join("|"),a.seatTypes=a.seatTypes.join("|"),$.post(c.attr("action"),a,function(a){a.status&&a.error?(h.templateShow({msg:a.error.errMsg,btn:h.getButton(a.error.buttons)}),e.removeAttr("disabled").val("提交订单")):d.location.href=a.data&&a.data.payUrl||""},"json").fail(function(){e.removeAttr("disabled").val("提交订单")})}var c=$(this),e=c.find("input[type=submit]"),f=j.data;if(a.preventDefault(),!e.attr("disabled")){if(f.seatNum<1)return h.templateShow({msg:"请至少选择一个座位。"}),void 0;if(!j.isConform())return h.templateShow({msg:j.data.seatNum>1?"请选择在一起的座位，不要留下单个空座":"请重新选择座位，旁边不要留下单个空座"}),void 0;e.attr("disabled","disabled").val("正在提交..."),j.checkBinding?j.checkBinding(function(a){a?e.removeAttr("disabled").val("提交订单"):b()}):b()}})},choose:function(a){a=$(a);var b=a.parents(".seat-item"),c=j.data,d=c.seatNum;0===d&&(c.sectionId=b.data("sectionid"),c.sectionName=b.data("sectionname"),c.showDate=b.data("showdate"),c.showId=b.data("showid"),c.poiId=b.data("poiid")),++c.seatNum,c.seats.push(a.data("row")+":"+a.data("column")),c.seatsNo.push(a.data("no")),c.seatTypes.push(a.data("type")),a.addClass("selected"),j.show()},cancel:function(a){a=$(a);var b=(a.parents(".seat-item"),j.data),c=b.seatNum;1===c&&(b.sectionId="",b.sectionName="",b.showDate="",b.showId="",b.poiId=""),--b.seatNum,j.remove(b.seats,a.data("row")+":"+a.data("column")),j.remove(b.seatsNo,a.data("no")),j.remove(b.seatTypes,a.data("type")),a.removeClass("selected"),j.show()},remove:function(a,b){a.splice($.inArray(b,a),1)},show:function(){var a=j.data.seats,b=$("#J_SeatShow");a.length?b.show():b.hide(),b.find("li").each(function(b){a[b]?$(this).addClass("selected").text(a[b].replace(":","排")+"座"):$(this).removeClass("selected").text(b+1)});var c=b.parents("form").find(".val"),d=a.length;c.eq(0).text(d),c.eq(1).html("&#165;"+this.NxF(d,b.data("price")));var e=c.eq(1).next(".fee");e.size()&&e.html("（含服务费&#165;"+this.NxF(d,b.data("fee"))+"）")},NxF:function(a,b){var c=(""+b).split("."),d=c[1]&&c[1].length;return d?a*c.join("")/Math.pow(10,d):a*b},isActive:function(a){return a.size()&&a.hasClass("active")&&!a.hasClass("selected")},isSelected:function(a){return a.size()&&a.hasClass("selected")},isXOX:function(a,b,c){var d=b(a);if(j.isActive(d)){if(d=b(d),j.isActive(d))return!1;if(j.isSelected(d))return!0;if(!j.isActive(d)){var e=4;for(d=a;e--;)if(d=c(d),!j.isSelected(d))return j.isActive(d)?!0:!1}}},isConform:function(){function a(a){return a.prev()}function b(a){return a.next()}for(var c,d=$("#J_SeatInfo .selected"),e=0,f=d.length;f>e;++e)if(c=d.eq(e),"N"===c.data("type")&&(j.isXOX(c,a,b)||j.isXOX(c,b,a)))return!1;return!0},insertSeats:function(a,b,c){b=b.split("|"),c=c.split("|");for(var d,e,f=$("#J_SeatInfo"),g=f.find(">.seat-item[data-sectionid="+a+"] a"),h=0,i=b.length;i>h;++h)d=b[h].split(":"),e=g.filter("[data-row="+d[0]+"][data-column="+d[1]+"]"),e[0].className="seat active",e[0].setAttribute("data-type",c[h]),j.choose(e)}};j.bindMobile=function(a){function b(){var a=g.val();/^1\d{10}$/.test(a)?f.removeClass("btn-disabled"):f.addClass("btn-disabled")}function c(){f.addClass("btn-disabled");var a=60,c=setInterval(function(){--a<1?(b(),f.text("重新发送"),clearInterval(c)):f.text(a+"秒后重试")},1e3)}function d(a,b){a=a||"",b?$("#J_BindMsg").addClass("msg-ok").text(a):$("#J_BindMsg").removeClass("msg-ok").text(a)}if(a=$(a),a[0]){var e,f=a.find("button"),g=f.prev(),h=f.next();g.keyup(b).blur(b),f.click(function(){f.hasClass("btn-disabled")||($.post(a.data("codeurl"),{mobile:g.val()},function(a){a&&!a.status?(d(a.message||"验证码已发送",!0),e=!0):d(a&&a.message||"发送失败，请稍后重试")},"json"),c())}),j.checkBinding=function(b){e&&h.val()?$.post(a.data("bindurl"),{mobile:g.val(),code:h.val(),cityId:a.data("cityid")},function(c){c&&!c.status?(j.checkBinding=function(a){a(null)},j.checkBinding(b),a.before('<p class="phone"><span class="gray">取票手机</span> '+g.val()+"</p>").hide()):(d(c&&c.message||"绑定手机号码失败，请稍后重试"),b("bind error"))},"json").fail(function(){b("send fail")}):(d(e?"请输入短信验证码":"请验证手机号码"),b("empty code"))}}},j.showTime=function(a){a=$(a),a.click(function(){return k.toggle(a),_ga("send","event","InnerLink","Click","shop/changeShow"),!1})};var k={_node:$("#show-time-tips"),attach:function(){var a=0;this._node.on("click",".J_Tab",function(){var b=$(this),c="selected",d=b.data("i");d!=a&&(b.addClass(c),b.siblings("[data-i="+a+"]").removeClass(c),k._node.find(".content").eq(d).addClass(c).end().eq(a).removeClass(c),a=d)}).click(function(a){a.stopPropagation()}),f.click(function(){k._node.hide()})},toggle:function(a){this._node.is(":hidden")?(this._node.show(),this.position(a),this.loadData(a.data("url"))):this._node.hide()},position:function(a){var b=a.offset(),c=a.outerWidth(),d=a.outerHeight();this._node.css({left:b.left+c-(this._node.width()||332)-2+"px",top:b.top+d-1+"px"})},loadData:function(a){var b=$.localStorage,c=(new Date).getTime(),e=b.getItem(a+"_time"),f=b.getItem(a);!f||e&&c-18e5>e?($.get(a,function(d){var e=$.parseJSON(d);e.status?h.templateShow({msg:d.errMsg||d.error&&d.error.errMsg||"未知错误，请刷新页面重试"}):(k.show(e.data),b.setItem(a,d),b.setItem(a+"_time",c),k.loadData=function(){})}).fail(function(){h.templateShow({msg:d.navigator.onLine===!1?"请连接您的网络后重试":"访问繁忙，请稍后重试"})}),f&&b.clear&&b.clear()):(k.show(f),k.loadData=function(){})},show:function(a){"string"==typeof a&&(a=$.parseJSON(a).data);var b,c=a.length,d=["<ul>"],e=[],f=0;if(c){for(;c>f;++f)b=1>f?"selected":"",d.push('<li class="J_Tab ',b,'" data-i="',f,'">',a[f].date,"</li>"),e.push('<div class="content ',b,'"><p>',this.getShowList(a[f].shows),"</p></div>");this.attach()}else d.push('<li class="selected">无数据...</li>'),e.push('<div class="content selected"><p>暂无相关场次信息。</p></div>');d.push("</ul>"),this._node.find(".hd").html(d.join("")).addBack().find(".bd").html(e.join(""))},getShowList:function(a){for(var b=0,c=a.length,d=[];c>b;++b)d.push('<a href="',a[b].seatUrl,'">',a[b].showTime,"</a>");return d.join("")}},l=d.Pay={status:0,countdown:function(a){var b,c=$("#J_RemainingTime"),e=c.data("time");return e>0?(b=d.setInterval(function(){if(0>e)return d.clearInterval(b),l.status||h.templateShow({msg:"已超过支付时间，该订单已自动取消",btn:a}),void 0;var f=e>60?d.parseInt(e/60)+" 分钟 ":"",g=e%60+" 秒";c.text(f+g),--e},1e3),void 0):(h.templateShow({msg:"您已超过支付时间",btn:a}),void 0)},showPayTip:function(){$(d.document.forms.payForm).submit(function(){return $(this).find("[name=payType]:checked").size()<1?(h.templateShow({msg:"请选择一家银行支付"}),!1):(h.show($("#pay-template").html()),l.status=1,void 0)})},toggle:function(a){a=$(a),a.find("h3").click(function(a){a.preventDefault(),$(this).find("i").toggleClass("selected").addBack().next("ul").toggle()})}}}),$(function(){$("body").on("click","[gaevent]",function(){var a=this.getAttribute("gaevent").split("|"),b=["send","event"];1===a.length?b.push("InnerLink","Click",a[0]):b=b.concat(a),_ga.apply(null,b)})});