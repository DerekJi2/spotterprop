<!--Review Form-->
<section id="write-review">
    <header>
        <h2>Write a Review</h2>
    </header>
    <form id="form-review" role="form" method="post" action="?" class="background-color-white">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="form-review-name">Name</label>
                    <input type="text" class="form-control" id="form-review-name" name="form-review-name" required="">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="form-review-email">Email</label>
                    <input type="email" class="form-control" id="form-review-email" name="form-review-email" required="">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="form-review-message">Message</label>
                    <textarea class="form-control" id="form-review-message" name="form-review-message"  rows="3" required=""></textarea>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Submit Review</button>
                </div>
                <!-- /.form-group -->
            </div>
            <div class="col-md-4">
                <aside class="user-rating">
                    <label>Value</label>
                    <figure class="rating active" data-name="value"></figure>
                </aside>
                <aside class="user-rating">
                    <label>Service</label>
                    <figure class="rating active" data-name="score"></figure>
                </aside>
            </div>
        </div>
    </form>
    <!-- /.main-search -->
</section>
<!--end Review Form-->