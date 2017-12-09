<?php $this -> load -> view('layout/header');?>
<nav class="navbar navbar-default">
    <div class='container'>
        <p class="navbar-text">Admin</p>
    </div>
</nav>
<div class="container admin">
    <?php echo form_open('admin/downloadList','class="form-inline" method="post" onsubmit="return Admin.validation();"', ''); ?>
    <!-- <form class="form-inline" onsubmit="return Admin.validation();" method="post" action="/admin/downloadList"> -->
        <div class="form-group">
            <label for="rssKeyword">RSS키워드</label>
            <input name="rssKeyword" type="text" class="form-control" id="rssKeyword" placeholder="ex) 무한도전">
        </div>
        <label class="mr-sm-2" for="destination">다운로드</label>
        <select name="destination" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="destination">
        <?php foreach($destinations as $dir) { ?>
            <?php if($dir['path'] === '') { ?>
                <option value=""><?php echo '==== '.$dir['name'].' ===='?></option>
            <?php } else { ?>
                <option value="<?php echo $dir['path'].'/'.$dir['name'] ?>"><?php echo $dir['name']?></option>
            <?php }?>
		<?php }?>
        </select>
        <select name="boardId" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="boardId">
            <?php foreach ($board_list as $key => $value) { ?>
                <option value="<?php echo $key?>"><?php echo $value?></option>
            <?php }?>
        </select>

        <button id="addDownload" type="submit" class="btn btn-primary">추가</button>
        <button class="btn btn-success" onclick="Admin.startAutoDownload(event)">자동다운로드 시작</button>
        <button class="btn btn-danger" onclick="Admin.stopAutoDownload(event)">자동다운로드 정지</button>
    <?php echo form_close(); ?>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>RSS키워드</th>
                    <th>다운로드</th>
                    <th>카테고리</th>
                    <th>삭제</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($download_list as $key => $value) { ?>
                    <tr>
                        <th scope="row"> <?php echo ($key+1) ?></th>
                        <td><?php echo $value['rss_keyword']?></td>
                        <td><?php echo $value['destination']?></td>
                        <td><?php echo $board_list[$value['board_id']]?></td>
                        <td><button onclick="Admin.delDownload(this, <?php echo $value['id']?>)"></button></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
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
                        <th scope="row"> <?php echo ($key+1) ?></th>
                        <td><?php echo $value['title']?></td>
                        <td><?php echo $value['created']?></td>
                        <td><button onclick="Admin.delDownloaded(this, <?php echo $value['id']?>)"></button></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div><!-- /.container -->
<script src="/assets/js/helper.js"></script>
<script src="/assets/js/admin.js"></script>
<?php $this -> load -> view('layout/footer');?>
