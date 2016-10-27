<?php $this -> load -> view('layout/header');?> 
<div class="container">      
      <?php echo form_open('/login/create_new_user','class="form-signup"'); ?>      
        <h2 class="form-signin-heading">회원가입</h2>
        <label for="inputEmail" class="sr-only">이메일</label>
        <input type="email" id="inputEmail" name="id" class="form-control" placeholder="이메일 주소" required autofocus>
        <label for="inputPassword" class="sr-only">패스워드</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="비밀번호" required>
        <label for="checkInputPassword" class="sr-only">비밀번호확인</label>
        <input type="password" id="checkInputPassword" name="checkPassword" class="form-control" placeholder="비밀번호 확인" required>                
        <button class="btn btn-lg btn-primary btn-block" type="submit">가입하기</button>
        <div class="form-group has-error has-feedback">
          <label class="control-label"><?php echo validation_errors(); ?></label>
        </div>
        
      <?php echo form_close(); ?>      
      

</div> <!-- /container -->
<?php $this -> load -> view('layout/footer');?>