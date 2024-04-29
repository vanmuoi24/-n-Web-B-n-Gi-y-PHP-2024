function valid(ele, cbFnc) {
	$(ele).submit(function (e) {
		e.preventDefault();
	});
	$(ele).validate({
		rules: {
			code: {
				required: true,
				isCode: true,
			},
			fullname: 'required',
			lastname: 'required',
			firstname: 'required',
			address: 'required',
			email: {
				required: true,
				isEmail: true,
			},
			phone: {
				required: true,
				isPhone: true,
			},
			passwordOld: 'required',
			passwordNew: {
				required: true,
				isPassword: true,
			},
			passwordConfirm: {
				required: true,
				equalTo: '#passwordNew',
			},
		},
		messages: {
			passwordOld: 'Trường này không được bỏ trống',
			fullname: 'Trường này không được bỏ trống',
			lastname: 'Trường này không được bỏ trống',
			firstname: 'Trường này không được bỏ trống',
			code: {
				required: 'Trường này không được bỏ trống',
			},
			address: 'Trường này không được bỏ trống',
			email: {
				required: 'Trường này không được bỏ trống',
			},
			passwordNew: {
				required: 'Trường này không được bỏ trống',
			},
			phone: {
				required: 'Trường này không được bỏ trống',
			},
			passwordConfirm: {
				required: 'Trường này không được bỏ trống',
				equalTo: 'Mật khẩu không trùng khớp',
			},
		},
		submitHandler: function () {
			cbFnc();
		},
	});
}
$.validator.addMethod(
	'isEmail',
	function (value, element) {
		// allow any non-whitespace characters as the host part
		return (
			this.optional(element) ||
			/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/.test(value)
			// /^[a-z]+[a-z-_\.0-9]{2,}@[a-z]+[a-z-_\.0-9]{2,}\.[a-z]{2,}$/i.test(
			// 	value
			// )
		);
	},
	'Email không hợp lệ'
);

$.validator.addMethod(
	'isCode',
	function (value, element) {
		// allow any non-whitespace characters as the host part
		// return this.optional(element) || /^KH\d{5}$/.test(value);
		return this.optional(element) || /^KH\d+$/.test(value);
	},
	'Mã khách hàng không hợp lệ'
);
$.validator.addMethod(
	'isPassword',
	function (value, element) {
		// allow any non-whitespace characters as the host part
		return (
			this.optional(element) ||
			/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/.test(value)
		);
	},
	'Mật khẩu 6-20 ký tự, ít nhất một chữ thường, hoa, số'
);
$.validator.addMethod(
	'isPhone',
	function (value, element) {
		// allow any non-whitespace characters as the host part
		return this.optional(element) || /^0\d{9}$/.test(value);
	},
	'Số điện thoại không hợp lệ'
);
