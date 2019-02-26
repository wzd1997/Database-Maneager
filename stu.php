<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stu.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="./jquery-3.3.1.js"></script>    
    <title>Document</title>
</head>
<body>
    <div class="header">
        <img src="./th.jpg" alt="">
        <div>学生管理系统</div>
    </div>
    <div class="fn">
        <div class="fn-header">学生管理</div>
        <ul class="fn-content">
            <li class="active">学生列表</li>
            <li>新增学生</li>
        </ul>
    </div>
    <div class="data">
        <table cellspacing="0" class="table">
            <thead>
                <tr>
                    <td>学号</td>
                    <td>姓名</td>
                    <td>性别</td>
                    <td>邮箱</td>
                    <td>出生年月</td>
                    <td>手机号</td>
                    <td>住址</td>
                    <td>操作</td>
                </tr>
            </thead>
            <tbody>
            <?php
                $conn = mysqli_connect('127.0.0.1','root','','stu',3306);
                $sql = "SET NAMES UTF8";
                mysqli_query($conn,$sql);
                $sql = "SELECT * FROM stu_message";
                $result = mysqli_query($conn,$sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<tr>';
                        echo "<td>$row[stu_id]</td>";
                        echo "<td>$row[stu_name]</td>";
                        echo "<td>$row[stu_sex]</td>";
                        echo "<td>$row[stu_email]</td>";
                        echo "<td>$row[stu_year]</td>";
                        echo "<td>$row[stu_phone]</td>";
                        echo "<td>$row[stu_addr]</td>";
                        echo "<td>
                                <button type='button' class='btn btn-success btn-xs edit' sid='$row[sid]'>编辑</button>
                                <button type='button' class='btn btn-danger btn-xs delete' sid='$row[sid]'>删除</button>
                              </td>";
                        echo '</tr>';
                    }
                };
            ?>
            </tbody>
        </table>
        
        <form class="form-horizontal" id="serialize">
            <div class="form-group stuidPosition">
                <label for="stuId" class="col-sm-2 control-label">学号：</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="stuId" name="stuId" placeholder="请输入学号">
                    
                </div>
                <p class="text-success stuidTest none">学号未被录入</p>
                <p class="text-danger stuidTest none">学号已经录入</p>
                <p class="text-warning stuidTest none">请输入正确的学号</p>
            </div>
            <div class="form-group">
                <label for="stuName" class="col-sm-2 control-label">姓名：</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="stuName" name="stuName" placeholder="请输入姓名">
                </div>
            </div>
            <div class="form-group">
                <label for="stuSex" class="col-sm-2 control-label">性别：</label>
                <div class=" col-sm-10"> 
                    <div class="radio">
                        <label>
                            <input type="radio" value="男" name="stuSex" checked> 男
                        </label>
                        <label>
                            <input type="radio"
                            value="女" name="stuSex"> 女
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group emailPosition">
                <label for="stuEmail" class="col-sm-2 control-label">邮箱：</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="stuEmail" name="stuEmail" placeholder="请输入邮箱">
                </div>
                <p class="text-warning emailTest none">请输入正确的邮箱</p>
            </div>
            <div class="form-group">
                <label for="stuBirthday" class="col-sm-2 control-label">出生年月：</label>
                <div class="col-sm-10">
                    <input type="month" class="form-control" id="stuBirthday" name="stuBirthday" placeholder="请输入出生年">
                </div>
            </div>
            <div class="form-group phonePosition">
                <label for="stuPhone" class="col-sm-2 control-label">手机号：</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="stuPhone" name="stuPhone" placeholder="请输入手机号">
                </div>
                <p class="text-warning phoneTest none">请输入正确的手机号</p>
            </div>
            <div class="form-group">
                <label for="stuAddr" class="col-sm-2 control-label">住址：</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="stuAddr" name="stuAddr" placeholder="请输入住址">
                </div>
            </div>
            <div class="form-group move">
                <div class="col-sm-offset-2 col-sm-10 btn_submit">
                <button type="submit" class="btn btn-default submit">提交</button>
                <button class="btn btn-default again">重置</button>
            </div>
            </div>
        </form>
    </div>
    <div class="againSub none" >
        <form class="form-horizontal" id="againSerialize">
            <input type="text" class="none" name="sid" id="sid">
            <div class="form-group stuidLocal">
                <label for="stuId" class="col-sm-2 control-label">学号：</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="stuId" name="stuId" placeholder="请输入学号">
                </div>
                <p class="text-success stuidTest none">学号未被录入</p>
                <p class="text-danger stuidTest none">学号已经录入</p>
                <p class="text-warning stuidTest none">请输入正确的学号</p>
            </div>
            <div class="form-group">
                <label for="stuName" class="col-sm-2 control-label">姓名：</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="stuName" name="stuName" placeholder="请输入姓名">
                </div>
            </div>
            <div class="form-group">
                <label for="stuSex" class="col-sm-2 control-label">性别：</label>
                <div class=" col-sm-10"> 
                    <div class="radio">
                        <label>
                            <input type="radio" value="男" name="stuSex" checked> 男
                        </label>
                        <label>
                            <input type="radio"
                            value="女" name="stuSex"> 女
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group emailLocal">
                <label for="stuEmail" class="col-sm-2 control-label">邮箱：</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="stuEmail" name="stuEmail" placeholder="请输入邮箱">
                </div>
                <p class="text-warning emailTest none">请输入正确的邮箱</p>
            </div>
            <div class="form-group">
                <label for="stuBirthday" class="col-sm-2 control-label">出生年月：</label>
                <div class="col-sm-10">
                    <input type="month" class="form-control" id="stuBirthday" name="stuBirthday" placeholder="请输入出生年">
                </div>
            </div>
            <div class="form-group phoneLocal">
                <label for="stuPhone" class="col-sm-2 control-label">手机号：</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="stuPhone" name="stuPhone" placeholder="请输入手机号">
                </div>
                <p class="text-warning phoneTest none">请输入正确的手机号</p>
            </div>
            <div class="form-group">
                <label for="stuAddr" class="col-sm-2 control-label">住址：</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="stuAddr" name="stuAddr" placeholder="请输入住址">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <input class="btn btn-default inpSubmit" type="button" value="提交">
                <input class="btn btn-default inpAgain" type="button" value="重置">
                <input class="btn btn-default inpCancle" type="button" value="取消">
            </div>
            </div>
        </form>
    </div>
    <script src="./stu.js"></script>
</body>
</html>