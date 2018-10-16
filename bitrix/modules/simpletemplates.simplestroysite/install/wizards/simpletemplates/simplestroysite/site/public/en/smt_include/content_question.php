<div class="smt-widget">
    <div class="smt-call-action-button">
        <div class="smt-call-action-button__icon"><span class="glyphicon glyphicon-star"></span></div>
        <div class="smt-call-action-button__content">
            <div class="container_flex-sm container_middle">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="smt-call-action-button__label"><?$APPLICATION->IncludeFile(
                                SITE_DIR."smt_include/content_question_header.php",
                                Array(),
                                Array("MODE"=>"html")
                            );?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="smt-call-action-button__button">
                            <?$APPLICATION->IncludeFile(
                                    SITE_DIR."smt_include/content_question_link.php",
                                    Array(),
                                    Array("MODE"=>"html")
                                );?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>