<?php $this -> load -> view('layout/header');?>
<nav class="navbar navbar-default">
    <div class='container'>
        <p class="navbar-text">Admin</p>
    </div>
</nav>
<div class="container admin">
    <form class="form-inline">
        <div class="form-group">
            <label for="rssKeyworld">RSS키워드</label>
            <input type="text" class="form-control" id="rssKeyworld" placeholder="Example input">
        </div>
        <label class="mr-sm-2" for="pathSelect">다운로드</label>
        <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="pathSelect">
            <option selected>선택</option>
            <option value="1">슬기로운깜빵생활</option>
        </select>
        <button id="addDownload" type="submit" class="btn btn-primary">추가</button>
    </form>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>RSS키워드</th>
                    <th>다운로드</th>
                    <th>삭제</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>
</div><!-- /.container -->
<script src="/assets/js/helper.js"></script>
<script src="/assets/js/admin.js"></script>
<?php $this -> load -> view('layout/footer');?>
