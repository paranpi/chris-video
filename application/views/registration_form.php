<?php $this -> load -> view('layout/header');?> 
<div class="container">      
      <?php echo form_open('/registration','class="form-signup"'); ?>      
        <h2 class="form-signin-heading">회원가입</h2>
        <label for="inputEmail" class="sr-only">이메일</label>
        <input type="email" id="inputEmail" name="email" value="<?php echo set_value('email'); ?>" class="form-control" placeholder="이메일 주소" required autofocus>
        <div class="has-error">
          <span class="control-label"><?php echo form_error('email'); ?></span>
        </div>        
        <label for="inputPassword" class="sr-only">패스워드</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="비밀번호" required>
        <div class="has-error">
          <span class="control-label"><?php echo form_error('password'); ?></span>
        </div>        
        <label for="checkInputPassword" class="sr-only">비밀번호확인</label>
        <input type="password" id="checkInputPassword" name="checkPassword" class="form-control" placeholder="비밀번호 확인" required>
        <div class="has-error">
          <span class="control-label"><?php echo form_error('checkPassword'); ?></span>
        </div>               
        <button class="btn btn-lg btn-primary btn-block" type="submit">가입하기</button>       
      <?php echo form_close(); ?>      
      

</div> <!-- /container -->
<?php $this -> load -> view('layout/footer');?>