<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>{{ trans('custom.page_title') }}</title>
    <!--Web default meta-->
    <meta name="robots" content="index, follow">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="{{ trans('custom.page_title') }}">
    <!--Web css-->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/animate_min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        #core .con {
          color: #666666;
          word-break: break-all;
          font-size: 16px;
          line-height: 24px;
        }
        #core .con p{
          margin-bottom: 30px;
          word-break: break-all;
        }

        #core .con li p{
          padding-top: 20px;
        }

        @media (min-width: 1024px) {
          /* line 365, ../sass/module/_layout.scss */
          #core .con {
            font-size: 18px;
            line-height: 34px;
          }
        }
        #core h4 {
          text-align: center;
          color: #66a371;
          line-height: 24px;
          margin: 0 0 15px 0;
        }
        @media (min-width: 1024px) {
          /* line 377, ../sass/module/_layout.scss */
          #core h4 {
            line-height: 30px;
            margin: 0 0 30px 0;
          }
        }
    </style>
</head>

<body id="index">
    <div id="navbar_top">
        <a id="rwd_nav" href="#m_nav">
            <div class="ico"><span></span></div>
        </a>
    </div>
    <!--上版-->
    @include('partials.header')
    <main id="main">
        <div class="inner">
            <section id="about">
                <h2 class="tit"><span>{{ trans('custom.traceabilty_about') }}?</span></h2>
                <div class="con">
                    <h4>
                        {{ trans('custom.traceabilty_system') }}
                        <br>
                        {{ trans('custom.traceabilty_implement') }}
                    </h4>
                    <p>
                        {!! trans('custom.traceabilty_description') !!}
                    </p>
                </div>
            </section>
            <section id="core">
                <h2 class="tit">{{ trans('custom.blockchain_about') }}?</h2>
                <div class="con">
                    <p>
                        {{ trans('custom.blockchain_description') }}
                    </p>
                    <h4>{{ trans('custom.core_value') }}</h4>
                    <ul>
                        <li>
                            <a href="#">
                                <span class="img"><img src="{{ asset('images/core_img01.svg') }}"></span>
                                <span class="txt">{{ trans('custom.traceability') }}</span>
                            </a>
                            <p>{{ trans('custom.core_value_1') }}</p>
                        </li>
                        <li>
                            <a href="#">
                                <span class="img">
                                    <img src="{{ asset('images/2.svg') }}">
                                </span>
                                <span class="txt">{{ trans('custom.decentralize') }}</span>
                            </a>
                            <p>{{ trans('custom.core_value_2') }}</p>
                        </li>
                        <li>
                            <a href="#">
                                <span class="img">
                                    <img src="{{ asset('images/3.svg') }}">
                                </span>
                                <span class="txt">{{ trans('custom.immutability') }}</span>
                            </a>
                            <p>{{ trans('custom.core_value_3') }}</p>
                        </li>
                        <li>
                            <a href="#">
                                <span class="img">
                                    <img src="{{ asset('images/4.svg') }}">
                                </span>
                                <span class="txt">{{ trans('custom.transparent') }}</span>
                            </a>
                            <p>{{ trans('custom.core_value_4') }}</p>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </main>
    <!--下版-->
    <footer id="footer">
        <div class="inner">
            <p>{{ trans('custom.sponsor') }}</p>
            <p>{{ trans('custom.maintain') }}</p>
            <p>{{ trans('custom.location') }}</p>
            <p>{{ trans('custom.service_line') }}：+886-2-33663468</p>
        </div>
    </footer>
    <!--Web jquery-->
    <script src="{{ asset('js/jquery-1.11.3.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery_pageslide_min.js') }}"></script>
    <script src="{{ asset('js/smartScroll.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#rwd_nav").pageslide({
                modal: true
            });
        });

        (function ($) {
            "use strict";
            // all parameters are optional
            smartScroll.init({
                speed: 700, // default 500
                addActive: true, // default true
                activeClass: "active", // default active
                offset: 150 // default 100
            }, function () {});
        })(jQuery);

    </script>
</body>

</html>
