<!DOCTYPE html>
<html lang="en">
<head>
    <title>FAQ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('assets/fonts/primary-fonts.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap-grid.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/animation/aos.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/css/faq.css') }}" type="text/css" rel="stylesheet" media="screen" />

    <style type="text/css">
        :root {
            
            --Primarycolor-rgb: 0, 110, 255;
            --notice-rgb: 251, 143, 20;
            --Headingcolor: #2680BC;
            --Bodytextcolor: #080808;
            /* // Button color */
            --Button_bg: #2680BC;
            --Button_textcolor: #FFFFFF;
            --Button_hovercolor: #2680BC;
            /* // Button color */

            /* // Header color */
            --Header_bg: #FFFFFF;
            --Header_Navigation_textcolor: #080808;
            --Header_element_color: #080808;
            /* // Header color */

            /* // Footer color */
            --Footer_bg: #080808;
            --Footer_Navigation_textcolor: #FFFFFF;
            --Footer_element_color: #FFFFFF;
            /* // Footer color */

            /* // Page color */
            --Page_bg: #FFFFFF;

            /* // Corner radius */
            --Button_Corner_radius: 5px;
            --Tiles_Corner_radius: 5px;
            --Corner_radius: 5px;
            /* // medium = 5,rounded = 50px,sqaure = 0*/

            /* // Alignment */
            --Alignment: left;

            /* //  FONTS Families */
            --Body_text: Proxima_Nova_Regular;
            --Proxima_Nova_SemiBold: Proxima_Nova_Semibold;
            --Heading_text: Proxima_Nova_Bold;
        }
    </style>
</head>
@include('layout.favicon')
<body class="common-pages">

    @include('layout.header')

    <section>
        <div class="section-inner">

            @include('layout.sidebar')

            <div class="main-content-section test-page">
                <h2> Frequently Asked Questions</h2>
                <div class="main-content-section-inner faq">
                    <div class="scroller-list">


                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        What is included in my purchase?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                You will receive the vial size of the injection that you selected along with packaging.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        If I accidentally freeze my vial what do I do?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    Contact us either through e-mail or phone. If calling us please select the extension for the pharmacy.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        What happens if I leave my vial sitting out of the refrigerator?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    If it is no more than 1 day it’s fine but if it is any longer, do not use and discard the vial.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        What happens if I leave my vial sitting out of the refrigerator?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    If it is no more than 1 day it’s fine but if it is any longer, do not use and discard the vial.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Are the pictures of the vials the actual vial that I will receive?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                No, the vials pictured are for promotional use only.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Can I use my own doctor or prescription?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                No, you must use our provider and they will determine if you qualify for a prescription.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        How many MCGs of Vitamin B12 are in each injection?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    1cc has 1,000mcg of vitamin B12.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Do you sell HCG?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    No, we do not sell or distribute any HCG products.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Do I have to have a prescription from my doctor to order your injectable products?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    No, you will have to be qualified by one of our physicians in order to purchase from our site.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        How do I get a prescription for your product?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                Create an account and fill out our medical history and medical consent forms for the physician to review. The physician will contact you to discuss your purchase. Once qualified by the physician, your order will be shipped directly to you from the pharmacy. Please contact us for any additional information on receiving a prescription.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Are these products tested?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                Yes, every batch is tested for solubility, PH stability, and many other sterility tests which include the following: bacterium, microbes, molds, fungi, pyrogens, and endotoxins.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve" aria-expanded="true" aria-controls="collapseTwelve">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Are these injections preservative free?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                No.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen" aria-expanded="true" aria-controls="collapseThirteen">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Why is PH stability testing important?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThirteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    To insure that the PH stability in the solution will remain the same until the assigned beyond use date has been passed.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFourteen" aria-expanded="true" aria-controls="collapseFourteen">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        What is the purpose of the beyond use date of a compounded sterile preparation (CSP)?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFourteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                A CSP’s beyond use date identifies the time by which the preparation once mixed- must be used before it is at risk for chemical degradation, contamination, and permeability of the packaging. In other words, the beyond use date serves to alert pharmacists and caregivers to the time after which a CSP cannot be administered. During the beyond use date testing each ingredient potency is evaluated for over a three month period. Each ingredient has to pass the sterility test for bacterium, microbes, molds, fungi, pyrogens, and endotoxins.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFifteen" aria-expanded="true" aria-controls="collapseFifteen">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        What is the difference between a beyond use date and an expiration date?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFifteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                An expiration date is identified by the product manufacturer. It is placed on the vial and in the package insert, and is dependent on the temperature and the appropriate storage of the unopened container. A beyond use date is assigned by the pharmacy fro a preparation that they compound.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSevteen" aria-expanded="true" aria-controls="collapseSevteen">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Where can I find the beyond use date?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSevteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                Once you receive your package in the mail. The beyond use date will be labeled on your bottle.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#Eighteen" aria-expanded="true" aria-controls="Eighteen">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        What is your Return Policy?
                                    </a>
                                </h4>
                            </div>
                            <div id="Eighteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                Per FDA regulations, prescription medications may not be returned once it is sent from the pharmacy. If you have any questions about the product you have received, please contact customer service.                                
                                If you believe you have received an incorrect medication; please do not take the medication and contact Customer Service immediately.
                            </div>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNineteen" aria-expanded="true" aria-controls="collapseNineteen">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Do you ship internationally or to Canada?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseNineteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                No, we do not ship internationally or to Canada. We are only able to ship our products within the United States. We are hoping to expand into international shipping in the near future. Sign up for our newsletter to receive notifications on when this will happen.
                            </div>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwenty" aria-expanded="true" aria-controls="collapseTwenty">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        How quickly does my package ship once I order it?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwenty" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                All orders are submitted the following day of your online consultation with our medical staff via secure video chat. You will receive a tracking number from the pharmacy once your order ships. The pharmacy usually ships same day if the prescription is received before 2:00pm EST.                            </div>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwetyone" aria-expanded="true" aria-controls="collapsetwetyone">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Do I have to be at home to receive my purchase?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapsetwetyone" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                We recommend that you ship your product to a work address or one where a trustworthy person can receive your order. We do send tracking information for each purchase, so you will know when to expect your purchase. You do not have to be at home when your purchase arrives.
                            </div>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwetytwo" aria-expanded="true" aria-controls="collapsetwetytwo">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Do you ship to P.O. boxes?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapsetwetytwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                No, it has to be a residence or your workplace.
                            </div>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwetytwo" aria-expanded="true" aria-controls="collapsetwetytwo">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        What if my order is damaged when it arrives?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapsetwetytwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                <a href="{{ env('APP_URL') }}/contact_us" style="color: #000; font-weight: bold">Contact us</a> immediately. Do not use if damaged or cap is off.
                            </div>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwetythree" aria-expanded="true" aria-controls="collapsetwetythree">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        I received my order, but was wondering, is there a diet to follow, what kind of results might I see?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapsetwetythree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                <a href="{{ env('APP_URL') }}/contact_us" style="color: #000; font-weight: bold">Contact us</a> about our online dietitian support program.</p>
                                </div>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwetyfour" aria-expanded="true" aria-controls="collapsetwetyfour">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        If your products are prescription strength injections, do I have to get an outside referral to order from you?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapsetwetyfour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                No, our trained medical staff will evaluate you once you contact us to make your first purchase.
                                </div>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwentyfive" aria-expanded="true" aria-controls="collapsetwentyfive">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        My packaging contains both a beyond use date and an expiration date. What is the difference? What is the purpose of the beyond use date of a compounded sterile preparation (CSP)?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapsetwentyfive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                Our injections are packaged following a compounded sterile preparation guideline, commonly referred to as a CSP. The beyond use date on the bottle outlines the time by which the injection must be used in order to guarantee maximum potency. If the beyond use date passes, the solution is subject to chemical degradation and possible contamination, rendering it unsafe for injection. An expiration date, on the other hand, is a specific date identified by the product manager. This date indicates how long the product will last when it is stored unopened at the proper temperature.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwentySix" aria-expanded="true" aria-controls="collapsetwentySix">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Do you accept insurance or flexible spending accounts?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapsetwentySix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                No, at this time we only accept credit card payments.                          
                                  </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwentySeven" aria-expanded="true" aria-controls="collapsetwentySeven">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Hours of Operation?                                    </a>
                                </h4>
                            </div>
                            <div id="collapsetwentySeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                We are a privately owned medical practice that specializes in medical weight loss and hormone replacement therapy. We are open Monday through Friday 9am-5pm.  We do not work holidays or weekends.                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwentyEight" aria-expanded="true" aria-controls="collapsetwentyEight">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        What happens if you miss your scheduled consultation with the medical provider?                                                </a>
                                </h4>
                            </div>
                            <div id="collapsetwentyEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                
                                You are charged a $50 missed appointment fee. You can’t proceed with your consultation until the $50 is paid in full. If you would like a refund instead of proceeding your telemedicine consultation, your payment will be refunded minus the $50 consultation fee.               </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwentyNine" aria-expanded="true" aria-controls="collapsetwentyNine">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Where can I track my order?                                </a>
                                </h4>
                            </div>
                            <div id="collapsetwentyNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                Please click on this page <a href="{{ env('APP_URL') }}/orders" style="color: #000; font-weight: bold">orders page</a> to track your order.</div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwentyTen" aria-expanded="true" aria-controls="collapsetwentyTen">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        How do I change my password?                             </a>
                                </h4>
                            </div>
                            <div id="collapsetwentyTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                Click on your photo to access your personel information. You will be able to change your pssword here.</div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwentyEleven" aria-expanded="true" aria-controls="collapsetwentyEleven">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        How can I schedule a consult with a doctor?                               </a>
                                </h4>
                            </div>
                            <div id="collapsetwentyEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                Please go to my "My appointeents" and click on '+' button to schedule a new consult.</div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwentyTweleve" aria-expanded="true" aria-controls="collapsetwentyTweleve">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        What are the different treatment options?                             </a>
                                </h4>
                            </div>
                            <div id="collapsetwentyTweleve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                Gone are the days when a doctor simply chooses the best course of action and dictates this choice to the patient, Epperly says.</div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwentyThirteen" aria-expanded="true" aria-controls="collapsetwentyThirteen">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        What outcome should I expect?                              </a>
                                </h4>
                            </div>
                            <div id="collapsetwentyThirteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                You may assume your life will return to normal following a surgery or other treatment protocol, for instance, but your doctor may know the best possible outcome is a small improvement in one or two of your symptoms.</div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwentyfourteen" aria-expanded="true" aria-controls="collapsetwentyfourteen">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Do we have to do this now, or can we revisit it later?                              </a>
                                </h4>
                            </div>
                            <div id="collapsetwentyfourteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                Doctors almost always have too much to do and too little time in which to do it. So when they meet with a patient, there’s the temptation to be as thorough as possible with tests or treatments.</div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwentyfifteen" aria-expanded="true" aria-controls="collapsetwentyfifteen">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Is there anything I can do on my own to improve my condition?                              </a>
                                </h4>
                            </div>
                            <div id="collapsetwentyfifteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                Lifestyle choices like what you eat, how much you move or sleep, and whether you smoke account for 70% of your risk for illness and disease, says Dr. Rob Danoff, a doctor of osteopathic medicine and a certified family physician with Philadelphia’s Aria Health System.</div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwentysixteen" aria-expanded="true" aria-controls="collapsetwentysixteen">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        What are the side effects?                            </a>
                                </h4>
                            </div>
                            <div id="collapsetwentysixteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                There’s always the possibility that what I do with medications could hurt a patient,” Epperly says. Whether that hurt comes in the form of headaches or skin rashes or mouth blisters.</div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title showAnswer">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwentyseveteen" aria-expanded="true" aria-controls="collapsetwentyseveteen">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        How will I hear about my test results?                           </a>
                                </h4>
                            </div>
                            <div id="collapsetwentyseveteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                Boissy calls it an age old problem: A patient undergoes an MRI or blood work, and then finds herself at home without any idea when or how she’ll hear from her doctor about her results. “The anxiety of waiting around and staring into the dark abyss of uncertainty is terrible,” Boissy says. Hopefully your doctor will be explicit about how you’ll get your results. But if not, you should ask.</div>
                            </div>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- including the scripts --}}
    @include('js_scripts.bottom_scripts')

    <script>
        // app url for global search
        var app_url = "{{ env('APP_URL') }}"

        $(document).ready(function() {
            AOS.init();
        });

        $(document)
        .find(".showAnswer")
        .each(function(index) {
            $(this).on("click", function() {
            $(this)
                .next()
                .toggleClass("content-area");
            });
        });
        function toggleIcon(e) {
            $(e.target)
                .prev('.panel-heading')
                .find(".more-less")
                .toggleClass('glyphicon-plus glyphicon-minus');
        }
        $('.panel-group').on('hidden.bs.collapse', toggleIcon);
        $('.panel-group').on('shown.bs.collapse', toggleIcon);
                   
    </script>
    <style>
        .content-area{
            display: none !important;
        }
        .showAnswer{
            cursor:pointer;
        }
    </style>

</body>
</html>