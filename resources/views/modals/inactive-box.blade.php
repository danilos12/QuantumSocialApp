
<div class="modal-large-anchor-inactive">
    <div class="modal-large-backdrop-inactive">

        <div id="showinactive" class=" modal-large-outer-upgrade">
                <div class="modal-box ">
                <div class="w-full flex justify-end">

                    <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="m-8 ui-icon  modal-large-close " id="close-inactive"/>
                </div>
                <div class="w-full flex justify-center"><span class="text-lg">&#9888;</span></div>
                <div class="flex flex-col h-full w-full items-center justify-center p-3 ">

                    <span class="text-center ">{{ $message ?? '' }}</span>
                    <button onclick="window.location.href='/#'" class="mt-12" style="background: #43ebf1; border: none; color: white; font-weight: 700;text-transform: uppercase;
                    padding: 0.5em 1em;
                    border-radius: 5px;">Update Payment</button>

                </div>


                </div>

        </div>

    </div>
</div>
<script>
//     $(document).ready(function () {
//         $modalParent = $('.modal-large-anchor-inactive');
//         $modalParentBlur = $('.modal-large-backdrop-inactive');
//         $(".modal-large-close").click(function (event) {

//             $('.modal-box').toggle("slide", { direction: "up" }, 350);
//         setTimeout(function () {
//         $modalParent.fadeOut("slow");
//         $modalParentBlur.fadeOut("slow");
//         $('.modal-large-anchor-inactive').attr('style', 'display: none');
//     }, 175);
// });

//     });
</script>
<style>

    .text-lg{
        font-size: 80px;
        line-height: 80px;
    }
    .text-center{
        text-align: center;
    }
    .m-8{
        margin: 2rem;
    }
    .mt-12{
        margin-top: 3rem;
    }
    .mb-12{
        margin-top: 3rem;
    }
    .pb-8{
        padding-bottom: 2rem;
    }
    .bg-red{
        background-color: red;-
    }
    .p-8{
        padding: 2rem;
    }
    .p-3{
        padding: 0.75rem;
    }
    .bg-blue{
        background-color: blue;
    }

    .w-full{
        width: 100%;
    }
    .h-full{
        height: 100%;
    }
    .h-80{
        height: 80%;
    }
    .h-20{
        height: 20%
    }
    .flex{
        display: flex;
    }
    .flex-col{
        flex-direction: column
    }
    .justify-end{
        justify-content: end
    }
    .justify-center{
        justify-content: center
    }
    .items-center{
        align-content: center;
    }

    .modal-box{
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 1rem;
        width: 25%;
        height: 25%;
        background-color: var(--frost-background);
    }
.modal-large-anchor-inactive {
    display: none;
        flex-direction: column;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: 79;
    }
    .modal-large-backdrop-inactive {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        width: 100%;
        height: 100vh;
        backdrop-filter: blur(50px);
        z-index: 100;
        background-color: var(--color-cosmic-purple-60);
    }

    .modal-large-outer-upgrade
    {
        width: 100%;
        height:100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        /* background: var(--frost-background); */
        color: var(--body-text);
        /* width: 70%; */
        /* height: 80vh; */

        border-radius: 10px;
        box-sizing: border-box;
    }
</style>

  <!-- END .main-settings-anchor -->




