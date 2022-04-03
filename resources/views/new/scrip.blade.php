<!-- <script src="/vendors/js/vendor.bundle.base.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>



<!-- End custom js for this page-->
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        let isShowNotice = sessionStorage.getItem("isShowNotice")
        if(isShowNotice) {
            $('#notice').hide()
        } else {
            $('#notice').show()
        }
        let pathInfo = window.location.pathname;
        let menu = @json(config('menu.MENUS'));
        let selectedMenu = menu.find(function (e) {
            return e.href == pathInfo;
        })
        if (selectedMenu) {
            $('.toolbar .nav-link.active').removeClass('active')
            $('.toolbar a[href="'+ selectedMenu.href + '"]').addClass('active')
        }

    })

    function hideNotice() {
        $('#notice').animate({  height: 'toggle'})
        sessionStorage.setItem("isShowNotice", true)
    }

</script>
<script>
    handleSelectGame = function(event) {
        value = event.target.value;
        if (!value) {
            return
        }
        window.location.href ='/game/' + value;
    }
    login = function () {
        window.location.href = '/login'
    }
    <?php
    try {
        $isInBlackList = true;
        if (Auth::user()->email) {
            $isInBlackList= \App\Blacklist::where('email', Auth::user()->email)->get();
            if (count($isInBlackList) > 0) {
                $isInBlackList = true;
            } else {
                $isInBlackList = false;
            }
        }
    } catch (Exception $e) {
        $isInBlackList = true;
    }
    ?>
    @if(!$isInBlackList)

    function Buy(e) {
        let package_tool = $(e).closest(':has(select)').find('select').val();
        let tool_id = $(e).closest(':has(select)').find('select').attr('name');
        let url = "{{route('tool.buy-tool', [":tool_id", ":package"])}}";
        url = url.replace(':tool_id', tool_id);
        url = url.replace(':package', package_tool);
        Swal.fire({
            title: 'Now loading',
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                Swal.showLoading();
            }
        })
        $.ajax({
            url: url,
            method: "GET",
            dataType: "JSON",
            success: function (response) {
                Swal.close();
                if (response.status === "success") {
                    Swal.fire({
                        title: '{{ trans('page.rent_successful') }}',
                        text: "Please check your email",
                        icon: 'success'
                    });
                } else {
                    Swal.fire({
                        title: '{{ trans('page.rent_failed') }}',
                        text: response.message,
                        icon: 'error'
                    }).then(function () {
                        if (response.code === 2) {
                            $("#recharge").show();
                        }
                        if (response.code === 190) {
                            window.location = "{{url('login')}}";
                        }
                    });
                }
            }
        })
    }

    @else
    function rechargeCoinPayments() {
        Swal.fire({
            title: 'You can not recharge',
            allowEscapeKey: true,
            icon : 'error',
        })
    }
    @endif

    function copyMessage(message) {
        var textArea = document.createElement("textarea");
        textArea.value = message;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("Copy");
        textArea.remove();
        Swal.fire({
            'title': "Copied",
            'text': message
        });
    }

    function DownloadLITE() {
        Swal.fire({
            text: 'Input your key to download lastest version',
            content: "input",
            button: {
                text: "Download now!",
                closeModal: false,
            },
        }).then(name => {
            if (!name) {
                swal.stopLoading();
                swal.close();
                throw null;
            }
            window.open('/download-lite/' + name, '_blank');
            swal.stopLoading();
            swal.close();
        })
    }
    $('#order-listing').DataTable({
        "paging": false
        "bDestroy": true,
        "language": {
            "lengthMenu": "Display _MENU_ order per page",
            "zeroRecords": "No orders were found",
            "info": "Showing page number _PAGE_/_PAGES_",
            "infoEmpty": "There are no orders",
            "search": "Search",
            "paginate": {
                "previous": "Previous page",
                "next": "Next page"
            }
        }
    });
</script>

<script>
    if (screen && screen.width < 900) {
        $('.menu-mobile').click(function(){
            $('.menu-mobile-container').fadeToggle()
            $('.menu').hide()
            $('.main').hide()
        })
        $('.close-icon').click(function(){
            $('.menu-mobile-container').fadeToggle()
            $('.menu').show()
            $('.main').show()
        })
    }
</script>
