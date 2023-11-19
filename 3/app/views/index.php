<?php
/** @var int $countPage */

$title = 'Users comments';
ob_start();
?>

    <div class="row gx-5">
        <div class="col-4 p-3"></div>
        <div class="col-4 p-3">
            <form method="POST" action="index.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input name="username" type="text" class="form-control" id="username" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Inter your comment</label>
                    <textarea name="comment" class="form-control" id="comment" rows="3"></textarea>
                </div>
                <div class="form-group col-sm-12 col-xs-12">
                    <input type="hidden" readonly="" name="_token" value="<?= $this->_token ?>">
                </div>
                 <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-4 p-3"></div>

        <hr>
    </div>

    <div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Comments</th>
                <th scope="col">Created</th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($comments)) {
                foreach ($comments as $comment): ?>
                    <tr>
                        <th scope="row" class="table-success col-md-auto"><?php echo $comment['user_id']; ?></th>
                        <td class="col-md-auto"><?php echo $comment['username']; ?></td>
                        <td class="col-8"><?php echo $comment['comment']; ?></td>
                        <td class="col-2"><?php echo $comment['date']; ?></td>
                    </tr>
                <?php endforeach;
            } ?>
            </tbody>
        </table>
    </div>

    <div class="pagination justify-content-center">
        <?php for ($p = 1; $p <= $countPage; $p++): ?>
            <a class="btn btn-outline-secondary btn-circle" href="?page=<?= $p ?>" role="button"><?= $p ?></a>
        <?php endfor; ?>
    </div>

<?php
$content = ob_get_clean();
include 'layout.php';
