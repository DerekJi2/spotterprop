<!--Page Content-->
<div id="page-content">
                <section class="container">
                    <div class="row">
                        <!--Content-->
                        <div class="col-md-9">
                            <header>
                                <h1 class="page-title"><?= get_lang("LISTING") ?></h1>
                            </header>
                            <figure class="filter clearfix">
                                <div class="buttons pull-left">
                                    <a href="<?=lang_site_url('Listing/Grid'); ?>" class="btn icon"><i class="fa fa-th"></i><?= get_lang("Grid") ?></a>
                                    <a href="<?=lang_site_url('Listing/List'); ?>" class="btn icon active"><i class="fa fa-th-list"></i><?= get_lang("List") ?></a>
                                </div>
                                <div class="pull-right">
                                    <aside class="sorting">
                                        <span><?= get_lang("Sorting") ?></span>
                                        <div class="form-group">
                                            <select class="framed" name="sort">
                                                <option value=""><?= get_lang("Date_Newest_First") ?></option>
                                                <option value="1"><?= get_lang("Date_Oldest_First") ?></option>
                                                <option value="2"><?= get_lang("Price_Highest_First") ?></option>
                                                <option value="3"><?= get_lang("Price_Lowest_First") ?></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </aside>
                                </div>
                            </figure>

                            <!--Listing List-->
                            <section class="block listing div-properties-container">
                            <?php 
                                $list = get_property_list();
                            ?>
                            <?php 
                            $count = 0;
                            $total_count = sizeof($list->data);
                            foreach ($list->data as $item) { 
                            ?>
                            <?php
                                $count++; 
                                $gallery = array_value($item->gallery, 0, "assets/img/syr/no-image-house.png");
                            ?>
                            <div class="div-property-item div-property-item-<?=$count;?> redefine-visible" id="div-item-<?=$item->id; ?>" data-createdon="<?=$item->date_created; ?>" data-propid="<?=$item->id; ?>" data-price="<?=$item->price; ?>">
                                <div class="item list">
                                    <div class="image">
                                        <div class="quick-view" data-propid="<?=$item->id; ?>"><i class="fa fa-eye"></i><span><?= get_lang('Quick_View') ?></span></div>
                                        <a href="<?=lang_site_url('Property/Detail/'.$item->id.'/'); ?>">
                                            <div class="overlay">
                                                <div class="inner">
                                                    <div class="content">
                                                        <h4><?= get_lang('Description') ?></h4>
                                                        <p><?=substr($item->description, 0, 100).' ...'; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-specific">
                                                <span title="<?= get_lang('Bedrooms') ?>"><img src="<?=site_url('assets/img/bedrooms.png'); ?>" alt=""><?=array_value($item->item_specific, "Bedrooms", 0); ?></span>
                                                <span title="<?= get_lang('Bathrooms') ?>"><img src="<?=site_url('assets/img/bathrooms.png'); ?>" alt=""><?=array_value($item->item_specific, "Bathrooms", 0); ?></span>
                                                <span title="<?= get_lang('Area') ?>"><img src="<?=site_url('assets/img/area.png'); ?>" alt=""><?=array_value($item->item_specific, "Area", 0); ?>m<sup>2</sup></span>
                                                <span title="<?= get_lang('Garages') ?>"><img src="<?=site_url('assets/img/garages.png'); ?>" alt=""><?=array_value($item->item_specific, "Garages", 0); ?></span>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-thumbs-up"></i>
                                            </div>
                                            <img src="<?=site_url($gallery); ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="wrapper">
                                        <a href="<?=lang_site_url('Property/Detail/'.$item->id.'/'); ?>"><h3><?=$item->title; ?></h3></a>
                                        <figure><?=$item->location; ?></figure>
                                        <div class="info">
                                            <div class="type">
                                                <i><img src="<?=site_url($item->type_icon); ?>" alt=""></i>
                                                <span><?= get_lang($item->type); ?></span>
                                            </div>
                                            <div class="price"><figure>$<?=$item->price; ?></figure></div>
                                            <!-- <div class="rating" data-rating="4"></div> -->
                                        </div>
                                    </div>
                                    <div class="hdn-property-json" style="display:none;"><?=json_encode($item); ?></div>
                                </div>
                            </div>
                            <?php } ?>
                            </section>
                            <!--end Listing List-->
                            <!--Pagination-->
                            <nav>
                                <ul class="pagination pull-right"></ul>
                                <input type="hidden" value="1" id="hdn-list-page-number" />
                            </nav>
                            <!--end Pagination-->
                        </div>
                        <!--Sidebar-->
                        <?php $this->view("Property/_page_sidebar"); ?>
                        <!--end Sidebar-->
                    </div>
                </section>
            </div>
            <!-- end Page Content-->