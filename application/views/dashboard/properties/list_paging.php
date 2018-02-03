<style>
.nav-prop-list-pagination {
    text-align:center;
}

.tr-row { display: none; }
</style>

<nav aria-label="Page navigation" class="nav-prop-list-pagination">
  <ul class="pagination">

  </ul>
</nav>

<div class="li-prev-button-template" style="display:none;">
    <li class="page-item">
      <a class="page-link" href="javascript:void(0);" onclick="AdminPropListPage.gotoPrev()" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
</div>

<div class="li-next-button-template" style="display:none;">
    <li class="page-item">
        <a class="page-link" href="javascript:void(0);" onclick="AdminPropListPage.gotoNext()" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
        </a>
    </li>
</div>

<div class="li-page-button-template" style="display:none;">
    <li class="page-item page-item-{{page-number}}" data-page="{{page-number}}">
        <a class="page-link" href="javascript:void(0);" onclick="AdminPropListPage.gotoPage({{page-number}})">{{page-number}}</a>
    </li>
</div>

<script type="text/javascript" src="assets/js/admin.proplist.pagination.js"></script>
<script type="text/javascript">
$(".prop-list-table").ready(function(){
    AdminPropListPage.initPageButtons();
    AdminPropListPage.gotoPage(1);
});


</script>