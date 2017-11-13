@extends('frontend.layout')

@section('content')
    <div class="p-gray-bg m-purchase">
        <div class="p-wrap-narrow">
            <h3 class="purchase-head">以太币的量化币申购钱包地址</h3>
            <div class="purchase-tips">
                <p>重要提示：</p>
                <p>本次量化币CQT申购仅接受使用以太坊ETH。</p>
                <p>请计算ETH参与金额及CQT认购数量，并向您的专属认购地址转入ETH。</p>
                <p>系统收到您的ETH后，可在量化币钱包中查看认购数量并提币。</p>
                <p>参与认购即认为您已充分了解项目情况并认知其运行风险。</p>
            </div>

            <div class="purchase-label">请计算参与数量</div>
            <div class="purchase-convert clearfix">
                <div class="purchase-input">
                    <input type="number" id="eth" size="4">
                    <div class="unit">ETH</div>
                </div>

                <div class="icon-exchange"></div>

                <div class="purchase-input">
                    <input type="number" id="cqt" size="8">
                    <div class="unit">CQT</div>
                </div>
            </div>

            <div class="text-tips">认购 <span id="cqt-val">0</span> 量化币CQT，请将 <span id="eth-val">0</span> ETH转入以下专属以太坊地址：
            </div>
            <div class="purchase-link">
                <button class="copy-btn" data-clipboard-target="#address">复制地址</button>
                <div class="link-input">
                    <input type="text" readonly id="address" value="{{ $user->user_unique_eth }}" class="btc">
                </div>
            </div>

            <div class="purchase-qrcode" id="qrcode"></div>

            <a href="/user"><div class="p-btn" >返回</div></a>
        </div>
    </div>

    <script src="/js/qrcode.min.js"></script>
    <script>
        var clipboard = new Clipboard('.copy-btn');
        clipboard.on('success', function (e) {
            layer.alert('复制成功');
        });

        var qrcode = new QRCode('qrcode');

        function makeCode(url) {
            if (!url) {
                url = '暂无钱包地址';
            }
            qrcode.makeCode(url);
        }

        var url = $('#address').val();
        makeCode(url);
        $('.p-checkbox').click(function () {
            var val = $(this).find('input').val();
            var url = $(this).find('input').data('url');
            $('.unit').text(val);
            $('#address').val(url);
            makeCode(url);
        });

        var modulus = 66666.6667;
        $('.purchase-input').find('input').on('input', function () {
            var val = $(this).val();
            var result = 0;
            if(val < 0) {
                $('#cqt').val(0);
                $('#cqt-val').text(0);
                result = 0;
                $('#eth').val(result);
                $('#eth-val').val(result);
                return;
            }

            if ($(this).attr('id') == 'cqt') {
                val = val.slice(0, 8);
                $('#cqt').val(val);
                $('#cqt-val').text(val);
                result = val / modulus;
                $('#eth').val(result);
                $('#eth-val').text(result);
                console.log(result);
                console.log(1);
            } else {
                val = val.slice(0, 8);
                $('#eth').val(val);
                $('#eth-val').text(val);
                result = Math.floor(val * modulus);
                $('#cqt').val(result);
                $('#cqt-val').text(result);
                console.log(result);
                console.log(2);
            }
        });
    </script>
@endsection