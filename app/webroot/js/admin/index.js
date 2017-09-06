$(document).ready(function(){
	// Validate slide form
	SlideAdminAddFormId = '#AddEditSlide';
	$(SlideAdminAddFormId).validate();
	$(SlideAdminAddFormId+' .coupon-applicable').click(function(){
		if(parseInt($(this).val())){
			$('.coupon-code').show();
			$('.coupon-code #SlideCouponCode').addClass('required');
		}else{
			$('.coupon-code').hide();
			$('.coupon-code #SlideCouponCode').removeClass('required');
			$('.coupon-code #SlideCouponCode').val('');
		}
	});
	// Validate language form
	AddEditLanguageFormId = '#AddEditLanguage';
	$(AddEditLanguageFormId).validate();

	// Validate category form
	AddEditCategoryFormId = '#AddEditCategory';
	$(AddEditCategoryFormId).validate();

	// Validate category form
	AddEditSubCategoryFormId = '#AddEditSubCategory';
	$(AddEditSubCategoryFormId).validate();

	// Validate category form
	AddEditProductFormId = '#AddEditProduct';
	$(AddEditProductFormId).validate();

	// Validate category form
	AddEditOptionFormId = '#AddEditOption';
	$(AddEditOptionFormId).validate();

	// Validate category form
	AddEditSubOptionFormId = '#AddEditSubOption';
	$(AddEditSubOptionFormId).validate();

});