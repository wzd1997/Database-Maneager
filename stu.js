$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

//图标跳转
$('.header img').on('click',function () {
    location.reload();
})
//切换展示内容
$('.fn .fn-content li').on('click', function () {
    $('.fn .fn-content li').removeClass();
    $(this).addClass('active');
    var name = $(this).html();
    if (name === '学生列表') {

        $('.data table').removeClass('none');
        $('.data form').hide();
    } else {
        $('.data table').addClass('none');
        $('.data form').show();
    }
})


//判断学号是否存在
$('.data #stuId').on('blur', function () {
    var stuIdValue = $(this).val();
    if (stuIdValue) {
        console.log(stuIdValue);
        //判断是否是10位数的学号
        var reg = /[0-9]{10}/g;
        var u = reg.exec(stuIdValue);
        if (u) {
            if (u[0] === u.input) {
                $('p').addClass('none');
                console.log(u)
                $.ajax({
                    url: 'testid.php?stuId=' + stuIdValue,
                    type: 'GET',
                    dataTpye: 'json',
                    data: [''],
                    success: function (res) {
                        // 查询是否存在
                        if (res[0] === 'yes') {
                            $('.text-danger').removeClass('none');;
                            $('.submit').attr("disabled", "disabled");
                        } else {
                            $('.text-success').removeClass('none');
                            $('.submit').removeAttr("disabled");
                        }
                    },
                    error: function (xhr, textStatus) {
                        console.log(xhr)
                        console.log(textStatus)
                        console.log(xhr.status)
                        console.log(xhr.responseText)
                    }
                })
                $('.stuidTest').addClass('none');
                $('.submit').removeAttr("disabled");
            } else {
                $('p').addClass('none');
                $('.text-warning.stuidTest').removeClass('none');
                $('.submit').attr("disabled", "disabled");
            }
        } else {
            $('.text-warning.stuidTest').removeClass('none');
            $('.submit').attr("disabled", "disabled");
        }
    }
})
// 判断邮箱
$('.data #stuEmail').on('blur', function () {
    var stuEmailValue = $(this).val();
    var regEmail = /@/g;
    var resultEmail = regEmail.exec(stuEmailValue);
    if (!resultEmail) {
        $('.form-group .emailTest').removeClass('none');
        $('.data form .submit').attr("disabled", "disabled");
    } else {
        $('.form-group .emailTest').addClass('none');
        $('.data form .submit').removeAttr("disabled");
    }
})
// 判断手机号
$('.data #stuPhone').on('blur', function () {
    var stuPhoneValue = $(this).val();
    var regPhone = /^(13|14|15|16|17|18|19)\d{9}$/g;
    var resultPhone = regPhone.exec(stuPhoneValue);
    if (!resultPhone) {
        console.log(111)
        $('.form-group .phoneTest').removeClass('none');
        $('.data form .submit').attr("disabled", "disabled");
    } else {
        $('.form-group .phoneTest').addClass('none');
        $('.data form .submit').removeAttr("disabled");
    }
})
//点击提交
var stop = true;
$(".data .submit").on('click', function (e) {
    e.preventDefault();
    if ($('#stuId').val()) {
        if ($('#stuName').val()) {
            if ($('#stuEmail').val()) {
                if ($('#stuBirthday').val()) {
                    if ($('#stuPhone').val()) {
                        if ($('#stuAddr').val()) {
                            if (stop) {
                                stop = false;
                                var dataPostValue = $('#serialize').serializeObject();
                                console.log(dataPostValue)
                                var firstHttp = $.ajax({
                                    url: 'stu_add.php',
                                    type: 'POST',
                                    dataTpye: 'json',
                                    data: dataPostValue,
                                    success: function (res) {
                                        alert('提交成功');
                                        stop = false;
                                        $('.again').addClass('none');
                                        if (res[0] === 'ok') {
                                            window.location.href = 'stu.php';
                                        }
                                        firstHttp.abort();
                                    },
                                    error: function (xhr, textStatus) {
                                        console.log(xhr)
                                        console.log(textStatus)
                                        console.log(xhr.status)
                                        console.log(xhr.responseText)
                                    }
                                });
                            }


                        } else {
                            alert('请输入住址');
                        }
                    } else {
                        alert('请输入手机号');
                    }
                } else {
                    alert('请选择出生年月');
                }
            } else {
                alert('请输入邮箱');
            }
        } else {
            alert('请输入姓名');
        }
    } else {
        alert('请输入学号');
    }
})
// 重置事件
$('.again').on('click', function (e) {
    e.preventDefault();
    $("input").val('');
    $('.data .submit').removeAttr("disabled");
    $('.form-group .emailtest').addClass('none');
    $('p').addClass('none');

})
// 编辑事件
$('.data .edit').on('click', function () {
    $('.againSub').removeClass('none');
    var editId = $(this).attr('sid');
    $.ajax({
        url: 'stu_selet_update.php',
        type: 'POST',
        dataTpye: 'json',
        data: {
            sid: editId
        },
        success: function (responseText) {
            $('.againSub form #stuId').val(responseText[0]);
            $('.againSub form #stuName').val(responseText[1]);
            console.log(responseText[2])
            if (responseText[2] === '男') {
                console.log($('.againSub form input[value = male]'))
                $('.againSub form input[value = 男]').attr('checked', 'checked');
            } else {
                $('.againSub form input[value = 女]').attr('checked', 'checked');
            }

            $('.againSub form #stuEmail').val(responseText[3]);
            $('.againSub form #stuBirthday').val(responseText[4]);
            $('.againSub form #stuPhone').val(responseText[5]);
            $('.againSub form #stuAddr').val(responseText[6]);
            $('.againSub form #sid').val(responseText[7]);
            console.log($('.againSub form #sid').val());

        },
        error: function (xhr, textStatus) {
            console.log(xhr)
            console.log(textStatus)
            console.log(xhr.status)
            console.log(xhr.responseText)
        }
    })
})
// 删除事件
$('.delete').on('click', function () {
    var deleteId = $(this).attr('sid');
    $.ajax({
        url: 'stu_delete.php',
        type: 'POST',
        dataTpye: 'json',
        data: {
            sid: deleteId
        },
        success: function (responseText) {
            if (responseText[0] === 'deleteOk') {
                alert('删除成功');
                window.location.href = 'stu.php';
            } else {
                alert('删除失败');
            }
        },
        error: function (xhr, textStatus) {
            console.log(xhr)
            console.log(textStatus)
            console.log(xhr.status)
            console.log(xhr.responseText)
        }
    })
})


$(".againSub .inpSubmit").on('click', function () {
    // e.preventDefault();
    if ($('.againSub #stuId').val()) {
        if ($('.againSub #stuName').val()) {
            if ($('.againSub #stuEmail').val()) {
                if ($('.againSub #stuBirthday').val()) {
                    if ($('.againSub #stuPhone').val()) {
                        if ($('.againSub #stuAddr').val()) {
                            var againPostValue = $('#againSerialize').serializeObject();
                            console.log(againPostValue);
                            console.log($('#againSerialize').serialize());
                            var secondHttp = $.ajax({
                                url: 'stu_update.php',
                                type: 'POST',
                                dataTpye: 'json',
                                data: againPostValue,
                                success: function (res) {
                                    alert('提交成功');
                                    $('.againSub').addClass('none');
                                    if (res[0] === 'ok') {
                                        window.location.href = 'stu.php';
                                    }
                                    secondHttp.abort();
                                },
                                error: function (xhr, textStatus) {
                                    console.log(xhr)
                                    console.log(textStatus)
                                    console.log(xhr.status)
                                    console.log(xhr.responseText)
                                }
                            });

                        } else {
                            alert('请输入住址');
                        }
                    } else {
                        alert('请输入手机号');
                    }
                } else {
                    alert('请选择出生年月');
                }
            } else {
                alert('请输入邮箱');
            }
        } else {
            alert('请输入姓名');
        }
    } else {
        alert('请输入学号');
    }
});

$('.againSub .inpAgain').on('click', function () {
    if ($('.againSub #stuId').val()) {
        $('.againSub .form-control').val('');
        $('.againSub .inpSubmit').removeAttr("disabled");
        $('.againSub .form-group .phoneTest').addClass('none');
        $('.againSub .form-group .emailTest').addClass('none');
    }
})
//判断学号是否存在
$('.againSub #stuId').on('blur', function () {
    var stuIdValue = $(this).val();
    if (stuIdValue) {
        console.log(stuIdValue);
        //判断是否是10位数的学号
        var reg = /[0-9]{10}/g;
        var u = reg.exec(stuIdValue);
        if (u) {
            if (u[0] === u.input) {
                $('p').addClass('none');
                console.log(u)
                $.ajax({
                    url: 'testid.php?stuId=' + stuIdValue,
                    type: 'GET',
                    dataTpye: 'json',
                    data: [''],
                    success: function (res) {
                        if (res[0] === 'yes') {
                            $('.againSub .text-danger').removeClass('none');;
                            $('.againSub .inpSubmit').attr("disabled", "disabled");
                        } else {
                            $('.againSub .text-success').removeClass('none');
                            $('.againSub .inpSubmit').removeAttr("disabled");
                        }
                    },
                    error: function (xhr, textStatus) {
                        console.log(xhr)
                        console.log(textStatus)
                        console.log(xhr.status)
                        console.log(xhr.responseText)
                    }
                })
                $('.againSub .stuidTest').addClass('none');
                $('.againSub .inpSubmit').removeAttr("disabled");
            } else {
                $('.againSub p').addClass('none');
                $('.againSub .text-warning.stuidTest').removeClass('none');
                $('.againSub .inpSubmit').attr("disabled", "disabled");
            }
        } else {
            $('.againSub .text-warning.stuidTest').removeClass('none');
            $('.againSub .inpSubmit').attr("disabled", "disabled");
        }
    }
})
$('.againSub #stuPhone').on('blur', function () {
    var editStuPhoneValue = $(this).val();
    var editRegPhone = /^(13|14|15|16|17|18|19)\d{9}$/g;
    var editResultPhone = editRegPhone.exec(editStuPhoneValue);
    if (!editResultPhone) {
        $('.againSub .form-group .phoneTest').removeClass('none');
        $('.againSub .inpSubmit').attr("disabled", "disabled");
    } else {
        $('.againSub .form-group .phoneTest').addClass('none');
        $('.againSub .inpSubmit').removeAttr("disabled");
    }
})
$('.againSub #stuEmail').on('blur', function () {
    var editStuEmailValue = $(this).val();
    var editRegEmail = /@/g;
    var editResultEmail = editRegEmail.exec(editStuEmailValue);
    if (!editResultEmail) {
        $('.againSub .form-group .emailTest').removeClass('none');
        $('.againSub .inpSubmit').attr("disabled", "disabled");
    } else {
        $('.againSub .form-group .emailTest').addClass('none');
        $('.againSub .inpSubmit').removeAttr("disabled");
    }
})
$('.againSub .inpCancle').on('click', function () {
    window.location.href = 'stu.php';
})