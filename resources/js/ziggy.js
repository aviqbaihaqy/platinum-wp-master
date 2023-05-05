const Ziggy = {"url":"http:\/\/platinum-wp-master.test","port":null,"defaults":{},"routes":{"login":{"uri":"login","methods":["GET","HEAD"]},"logout":{"uri":"logout","methods":["POST"]},"register":{"uri":"register","methods":["GET","HEAD"]},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"]},"password.email":{"uri":"password\/email","methods":["POST"]},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"]},"password.update":{"uri":"password\/reset","methods":["POST"]},"index":{"uri":"\/","methods":["GET","HEAD"]},"about":{"uri":"about","methods":["GET","HEAD"]},"contact":{"uri":"contact","methods":["GET","HEAD"]},"terms":{"uri":"terms","methods":["GET","HEAD"]},"contact.post":{"uri":"contact","methods":["POST"]},"cart.addToCart":{"uri":"addToCart","methods":["POST"]},"cart.pluckItem":{"uri":"pluckItem\/{position}","methods":["GET","HEAD"]},"products.showByUri":{"uri":"products\/{uri}","methods":["GET","HEAD"]},"products.showByCategory":{"uri":"products\/category\/{category_name}","methods":["GET","HEAD"]},"products.searchNavbar":{"uri":"search","methods":["GET","HEAD"]},"products.index":{"uri":"products","methods":["GET","HEAD"]},"products.create":{"uri":"products\/create","methods":["GET","HEAD"]},"products.store":{"uri":"products","methods":["POST"]},"products.show":{"uri":"products\/{product}","methods":["GET","HEAD"]},"products.edit":{"uri":"products\/{product}\/edit","methods":["GET","HEAD"]},"products.update":{"uri":"products\/{product}","methods":["PUT","PATCH"]},"products.destroy":{"uri":"products\/{product}","methods":["DELETE"]},"members.carts":{"uri":"member\/cart\/{user_id?}","methods":["GET","HEAD"]},"profile":{"uri":"member\/profile\/{user_id?}","methods":["GET","HEAD"]},"members.privacy":{"uri":"member\/privacy\/{user_id}","methods":["GET","HEAD"]},"members.invoices":{"uri":"member\/invoices\/{user_id?}","methods":["GET","HEAD"]},"members.viewInvoice":{"uri":"member\/invoices\/view\/{invoice_id}","methods":["GET","HEAD"]},"users.data":{"uri":"member\/{user_id}\/get_details","methods":["GET","HEAD"]},"profile.update":{"uri":"member\/profile\/{user_id}\/update","methods":["PUT","PATCH"]},"profile.updateProfilePhoto":{"uri":"member\/profile\/{user_id}\/profile_photo\/update","methods":["PUT","PATCH"]},"members.updatePassword":{"uri":"member\/privacy\/{user_id}\/update","methods":["PUT","PATCH"]},"members.checkoutCart":{"uri":"member\/cart\/{user_id}\/checkout","methods":["POST"]},"members.destroyCart":{"uri":"member\/cart\/{cart_id}\/destroy","methods":["DELETE"]},"members.getShippingAddressData":{"uri":"member\/shipping_address\/{address_id}\/get_details","methods":["GET","HEAD"]},"members.addShippingAddress":{"uri":"member\/{user_id?}\/shipping_address","methods":["POST"]},"members.updateShippingAddress":{"uri":"member\/shipping_address\/{address_id}","methods":["PUT","PATCH"]},"members.destroyShippingAddress":{"uri":"member\/shipping_address\/{address_id}\/destroy","methods":["DELETE"]},"members.pay":{"uri":"member\/pay","methods":["GET","HEAD"]},"members.updateMidtransPaymentStatus":{"uri":"member\/payment\/{midtrans_id}\/status","methods":["GET","HEAD"]},"members.finishPayment":{"uri":"member\/pay\/finish","methods":["POST"]},"login.staff":{"uri":"staff","methods":["GET","HEAD"]},"login.admin":{"uri":"admin","methods":["GET","HEAD"]},"dashboard.index":{"uri":"dashboard","methods":["GET","HEAD"]},"dashboard.notifications.readAll":{"uri":"dashboard\/notifications\/{user_id}\/read-all","methods":["GET","HEAD"]},"dashboard.invoices":{"uri":"dashboard\/invoices","methods":["GET","HEAD"]},"dashboard.invoices.getInvoiceData":{"uri":"dashboard\/invoices\/{invoice_id}\/get_details","methods":["GET","HEAD"]},"dashboard.invoices.insertOrUpdateShippingData":{"uri":"dashboard\/invoices\/{invoice_id}\/update_shipping","methods":["POST"]},"dashboard.invoices.manuallyAddInvoiceItem":{"uri":"dashboard\/invoices\/{invoice_id}\/manually_add_invoice_item","methods":["POST"]},"dashboard.invoices.manuallyCreateInvoice":{"uri":"dashboard\/invoices\/manually_create_invoice","methods":["POST"]},"dashboard.invoices.destroy":{"uri":"dashboard\/invoices\/{invoice_id}\/destroy","methods":["DELETE"]},"dashboard.users.profile":{"uri":"dashboard\/user\/{user_id}\/profile","methods":["GET","HEAD"]},"dashboard.users.data":{"uri":"dashboard\/user\/{user_id}\/get_details","methods":["GET","HEAD"]},"dashboard.users.staffs":{"uri":"dashboard\/staffs","methods":["GET","HEAD"]},"dashboard.users.members":{"uri":"dashboard\/members","methods":["GET","HEAD"]},"dashboard.staffs.store":{"uri":"dashboard\/staffs","methods":["POST"]},"dashboard.users.members.update":{"uri":"dashboard\/user\/{user_id}\/update","methods":["PUT","PATCH"]},"dashboard.users.self-update":{"uri":"dashboard\/user\/{user_id}\/self_update","methods":["PUT","PATCH"]},"dashboard.users.staffs.update":{"uri":"dashboard\/staff\/{user_id}\/update","methods":["PUT","PATCH"]},"dashboard.users.destroy":{"uri":"dashboard\/user\/{user_id}\/destroy","methods":["DELETE"]},"dashboard.carts":{"uri":"dashboard\/carts","methods":["GET","HEAD"]},"dashboard.carts.destroyUserCart":{"uri":"dashboard\/carts\/{user_id}\/destroy_user_cart","methods":["DELETE"]},"dashboard.sales":{"uri":"dashboard\/sales","methods":["GET","HEAD"]},"dashboard.stocks":{"uri":"dashboard\/stocks","methods":["GET","HEAD"]},"dashboard.products.lists":{"uri":"dashboard\/products\/subcategory\/{subcategoryName?}","methods":["GET","HEAD"]},"dashboard.products.showDetail":{"uri":"dashboard\/products\/{product_id}","methods":["GET","HEAD"]},"dashboard.products.get-data":{"uri":"dashboard\/products\/{product_id}\/get_details","methods":["GET","HEAD"]},"dashboard.products.updateDescription":{"uri":"dashboard\/products\/{product_id}\/update_description","methods":["PUT","PATCH"]},"dashboard.products.destroyAndRedict":{"uri":"dashboard\/products\/{product_id}\/deleteAndRedirect","methods":["DELETE"]},"dashboard.products.getAttributeData":{"uri":"dashboard\/products\/attribute\/{attribute_id}\/get_details","methods":["GET","HEAD"]},"dashboard.products.attribute.store":{"uri":"dashboard\/products\/add_attribute","methods":["POST"]},"dashboard.products.updateAttribute":{"uri":"dashboard\/products\/attribute\/{attribute_id}\/update_attribute","methods":["PUT","PATCH"]},"dashboard.products.attribute.destory":{"uri":"dashboard\/products\/attribute\/{attribute_id}\/destroy","methods":["DELETE"]},"dashboard.products.getTerms":{"uri":"dashboard\/products\/term\/{product_id}\/get_details","methods":["GET","HEAD"]},"dashboard.products.term.updateOrCreate":{"uri":"dashboard\/products\/{product_id}\/editorupdatewarranty","methods":["POST"]},"dashboard.products.dimension.store":{"uri":"dashboard\/products\/{product_id}\/add_dimension","methods":["POST"]},"dashboard.products.dimension.update":{"uri":"dashboard\/products\/dimension\/{dimension_id}\/update","methods":["PUT","PATCH"]},"dashboard.products.dimension.destory":{"uri":"dashboard\/products\/dimension\/{dimension_id}\/destroy","methods":["DELETE"]},"dashboard.products.photo.add":{"uri":"dashboard\/products\/{product_id}\/upload_photos","methods":["POST"]},"dashboard.products.photo.update":{"uri":"dashboard\/products\/photo\/{photo_id}\/update","methods":["PUT","PATCH"]},"dashboard.products.photo.destory":{"uri":"dashboard\/products\/photo\/{photo_id}\/destroy","methods":["DELETE"]},"dashboard.products.banner.updateOrCreate":{"uri":"dashboard\/products\/banner\/{product_id}\/updateOrCreateBanner","methods":["PUT","PATCH"]},"dashboard.products.banner.destory":{"uri":"dashboard\/products\/banner\/{banner_id}\/destroy","methods":["DELETE"]},"dashboard.feedbacks":{"uri":"dashboard\/feedbacks","methods":["GET","HEAD"]},"dashboard.feedbacks.show":{"uri":"dashboard\/feedbacks\/{feedback_id}\/get_details","methods":["GET","HEAD"]},"dashboard.feedbacks.destroy":{"uri":"dashboard\/feedbacks\/{feedback_id}","methods":["DELETE"]},"dashboard.products.index":{"uri":"dashboard\/products","methods":["GET","HEAD"]},"dashboard.products.create":{"uri":"dashboard\/products\/create","methods":["GET","HEAD"]},"dashboard.products.store":{"uri":"dashboard\/products","methods":["POST"]},"dashboard.products.show":{"uri":"dashboard\/products\/{product}","methods":["GET","HEAD"]},"dashboard.products.edit":{"uri":"dashboard\/products\/{product}\/edit","methods":["GET","HEAD"]},"dashboard.products.update":{"uri":"dashboard\/products\/{product}","methods":["PUT","PATCH"]},"dashboard.products.destroy":{"uri":"dashboard\/products\/{product}","methods":["DELETE"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
