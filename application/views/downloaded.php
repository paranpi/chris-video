<?php $this -> load -> view('layout/header');?>
<nav class="navbar navbar-default">
  <div class="container">
    <ul class="nav navbar-nav">
      <li><a href="/admin">Home</a></li>
      <li class="active"><a>Dwonloaded</a></li>
    </ul>
  </div>
</nav>
<div class="container admin">
    <div>
        <div>
            <h4>다운로드완료 목록</h3>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>타이틀</th>
                    <th>날짜</th>
                    <th>삭제</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($downloaded_list as $key => $value) { ?>
                    <tr>
                        <th scope="row"> <?php echo ($start_num + $key +1) ?></th>
                        <td><?php echo $value['title']?></td>
                        <td><?php echo $value['created']?></td>
                        <td><button onclick="Admin.delDownloaded(this, <?php echo $value['id']?>)"></button></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
          <ul class="pagination">
              <?php echo $this->pagination->create_links(); ?>
          </ul>
        </nav>
    </div>
</div><!-- /.container -->
<script src="/assets/js/helper.js"></script>
<script src="/assets/js/admin.js"></script>
<?php $this -> load -> view('layout/footer');?>
