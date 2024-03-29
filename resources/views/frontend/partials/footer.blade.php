<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-xs-12 ft-link ft-information ft-title">
                    <div class="block-title @if($isEdit) edit @endif" data-text="4">{!! $textList[4] !!}</div>
                    <div class="block-cotent">
                        <ul class="list">
                            @if($footerLink1)
                            @foreach($footerLink1 as $link)
                            <li><a href="{{ $link->link_url }}" title="{!! $link->link_text !!}">{!! $link->link_text !!}</a></li>
                            @endforeach
                            @endif                          
                        </ul>
                    </div>
                </div><!-- /ft-information-->
                <div class="col-sm-4 col-xs-12 ft-link ft-links ft-title">
                    <div class="item">
                        <div class="block-title @if($isEdit) edit @endif" data-text="5">{!! $textList[5] !!}</div>
                        <div class="block-cotent">
                            <ul class="list">
                                @if($footerLink2)
                                @foreach($footerLink2 as $link)
                                <li><a href="{{ $link->link_url }}" title="{!! $link->link_text !!}">{!! $link->link_text !!}</a></li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div><!-- /item-->
                    <div class="item">
                        <div class="block-title @if($isEdit) edit @endif" data-text="7">{!! $textList[7] !!}</div>
                        <div class="block-cotent">
                            <div class="resgis-form">
                                
                                <input type="input" name="txtNewsletter" id="txtNewsletter" value="" placeholder="Nhập email của bạn...">
                                <button type="button" name="btnNewsletter" id="btnNewsletter" class="btn-regis">Đăng ký</button>
                                
                            </div>
                        </div>
                    </div><!-- /item-->
                </div><!-- /ft-links-->
                <div class="col-sm-4 col-xs-12 ft-contact ft-title">
                    <div class="block-title @if($isEdit) edit @endif" data-text="6">{!! $textList[6] !!}</div>
                    <div class="block-content">
                        <address>
                           {!! $settingArr['chi_nhanh_phia_nam'] !!}
                        </address>
                        <address>
                            {!! $settingArr['chi_nhanh_phia_bac'] !!}
                        </address>
                    </div>
                </div><!-- /ft-contact-->
            </div>
        </div>
    </div><!-- /footer-top-->
   
    <a id="return-to-top" class="td-scroll-up" href="javascript:void(0)">
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </a><!-- return to top -->
    <div class="block-hotline-mb" href="javascript:void(0)">
            <p><a href="tel:{{ $settingArr['hotline'] }}">{{ $settingArr['hotline'] }}</a></p>
        </div><!-- return to top -->
    </footer><!-- footer -->