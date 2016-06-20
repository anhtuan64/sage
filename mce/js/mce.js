/**
 * This file for register button insert shortcode to TinyMCE.
 *
 * @since  1.0
 * @author KingKongThemes
 * @link   http://www.kingkongthemes.com
 */
 
(function() {
	tinymce.create('tinymce.plugins.rt_pre_shortcodes_button', {
		init : function(ed, url) {
			title = 'rt_pre_shortcodes_button';
			tinymce.plugins.rt_pre_shortcodes_button.theurl = url;
			ed.addButton('rt_pre_shortcodes_button', {
				title	:	'Select Shortcode',
				icon	:	'rt_icon',
				type : 'menubutton',
				/* List Button */
				menu: [
					

					{
						text: 'Blog',
						value: 'Blog',
						menu: [
							/* -----------Rt Blog-----------	*/
							{
								text: 'Rt Blog',
								value: 'Rt Blog',
								onclick: function() {
									ed.windowManager.open( {
										title: 'Rt Blog',
										body: [
											{type : 'listbox', name : 'style', label						:	'Style', 'values': [{text: 'Style 1', value: '1'}, {text: 'Style 2', value: '2'}, {text: 'Style 3', value: '3'}]},
											{type : 'textbox', name : 'posts_per_page', label				:	'Số lượng bài viết', value : '5'},
											{type : 'textbox', name : 'categories', label					:	'Danh mục (Id / Slug)', value : ''},
											{type : 'textbox', name : 'custom_text', label					:	'Sửa chữ "xem thêm"', value : 'Xem Thêm'},
											{type : 'textbox', name : 'custom_link', label					:	'Link xem thêm', value : ''},
											{type : 'listbox', name : 'hide_category', label				:	'Ẩn danh mục', 'values': [{text: 'Hiện', value: '1'}, {text: 'Ẩn', value: '0'}]},
											{type : 'listbox', name : 'hide_viewmore', label				:	'Ẩn nút xem thêm', 'values': [{text: 'Hiện', value: '1'}, {text: 'Ẩn', value: '0'}]},
										],	
										onsubmit: function(e){
											ed.insertContent( '[rtblog style="'+ e.data.style +'" posts_per_page="'+ e.data.posts_per_page +'" categories="'+ e.data.categories +'" custom_text="'+ e.data.custom_text +'" custom_link="'+ e.data.custom_link +'" hide_category="'+ e.data.hide_category +'" hide_viewmore="'+ e.data.hide_viewmore +'"][/rtblog]');
										}
									});
								}
							},	// Rt Blog

							/* -----------Rt Blog Carousel-----------	*/
							{
								text: 'Rt Blog Carousel',
								value: 'Rt Blog Carousel',
								onclick: function() {
									ed.windowManager.open( {
										title: 'Rt Blog Carousel',
										body: [
											{type : 'listbox', name : 'style', label						:	'Style', 'values': [{text: 'Style 1', value: '1'}, {text: 'Style 2', value: '2'}, {text: 'Style 3', value: '3'}]},
											{type : 'textbox', name : 'posts_per_page', label				:	'Số lượng bài viết', value : '5'},
											{type : 'textbox', name : 'categories', label					:	'Danh mục (Id / Slug)', value : ''},
											{type : 'textbox', name : 'posts_per_slide', label				:	'Số lượng bài viết / slide', value : '1'},
											{type : 'listbox', name : 'hide_category', label				:	'Ẩn danh mục', 'values': [{text: 'Hiện', value: '1'}, {text: 'Ẩn', value: '0'}]},
											{type : 'listbox', name : 'hide_viewmore', label				:	'Ẩn nút xem thêm', 'values': [{text: 'Hiện', value: '1'}, {text: 'Ẩn', value: '0'}]},
										],	
										onsubmit: function(e){
											ed.insertContent( '[rtblog_carousel style="'+ e.data.style +'" posts_per_page="'+ e.data.posts_per_page +'" categories="'+ e.data.categories +'" posts_per_slide="'+ e.data.posts_per_slide +'" hide_category="'+ e.data.hide_category +'" hide_viewmore="'+ e.data.hide_viewmore +'"][/rtblog_carousel]');
										}
									});
								}
							},	// Rt Blog Carousel

							/* -----------Rt Teacher Carousel-----------	*/
							{
								text: 'Rt Teacher Carousel',
								value: 'Rt Teacher Carousel',
								onclick: function() {
									ed.windowManager.open( {
										title: 'Rt Teacher Carousel',
										body: [
											{type : 'textbox', name : 'posts_per_page', label				:	'Số lượng bài viết', value : '5'},
											{type : 'listbox', name : 'column', label						:	'Số lượng bài viết / Slide', 'values': [{text: '1', value: '1'}, {text: '2', value: '2'}, {text: '3', value: '3'}, {text: '4', value: '4'}, {text: '5', value: '5'}, {text: '6', value: '6'}], value : '4' },
											{type : 'textbox', name : 'margin_item', label					:	'Khoảng cách giữa 2 bài viết ( pixel )', value : '50'},
											{type : 'listbox', name : 'autoplay', label						:	'Tự động chạy', 'values': [{text: 'Có', value: 'yes'}, {text: 'Không', value: 'no'}]},
											{type : 'listbox', name : 'touch_scroll', label					:	'Cho phép chạm để kéo slide', 'values': [{text: 'Có', value: 'yes'}, {text: 'Không', value: 'no'}]},
											{type : 'listbox', name : 'navigation', label					:	'Nút điều hướng slide', 'values': [{text: 'Hiện', value: '1'}, {text: 'Ẩn', value: '0'}]},
										],	
										onsubmit: function(e){
											ed.insertContent( '[rtteacher_carousel posts_per_page="'+ e.data.posts_per_page +'" column="'+ e.data.column +'" margin_item="'+ e.data.margin_item +'" autoplay="'+ e.data.autoplay +'" touch_scroll="'+ e.data.touch_scroll +'" navigation="'+ e.data.navigation +'"][/rtteacher_carousel]');
										}
									});
								}
							},	// Rt Teacher Carousel
						], // 
					},	// 
					
					
				],
			});

		},
		createControl : function(n, cm) {
			return null;
		}
	});

	tinymce.PluginManager.add('rt_pre_shortcodes_button', tinymce.plugins.rt_pre_shortcodes_button);

})();