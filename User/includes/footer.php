<style>
    #footer {
        color: white;
    }

    .pull-left {
        color: black;
    }

    .pull-right {
        color: white;
    }

    div.contact-timing table.table td {
        color: white;
    }
</style>
<footer id="footer" class="footer color-bg">
    <div class="links-social inner-top-sm">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <!-- ============================================================= CONTACT INFO ============================================================= -->
                    <div class="contact-info">
                        <div class="footer-logo">
                            <div class="logo">
                                <a href="index.php">

                                    <h3>Shopping Portal</h3>
                                </a>
                            </div><!-- /.logo -->

                        </div><!-- /.footer-logo -->

                        <div class="module-body m-t-20">
                            <p class="about-us"> This is the emerging e-commerce site. We value each customer. Customer
                                satisfaction is our first priority. Quality is what made us reknown.</p>

                            <div class="social-icons">

                                <a href="http://facebook.com" class='active'><i class="icon fa fa-facebook"></i></a>
                                <a href="#"><i class="icon fa fa-twitter"></i></a>
                                <a href="#"><i class="icon fa fa-linkedin"></i></a>
                                <a href="#"><i class="icon fa fa-rss"></i></a>
                                <a href="#"><i class="icon fa fa-pinterest"></i></a>

                            </div><!-- /.social-icons -->
                        </div><!-- /.module-body -->

                    </div><!-- /.contact-info -->
                    <!-- ============================================================= CONTACT INFO : END ============================================================= -->
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-4">
                    <!-- ============================================================= CONTACT TIMING============================================================= -->
                    <div class="contact-timing">
                        <div class="module-heading">
                            <h4 class="module-title">Opening Time</h4>
                        </div><!-- /.module-heading -->

                        <div class="module-body outer-top-xs">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Monday-Friday:</td>
                                            <td class="pull-right">08:00 AM To 6:00 PM</td>
                                        </tr>
                                        <tr>
                                            <td>Saturday:</td>
                                            <td class="pull-right">09:00 AM To 8:00 PM</td>
                                        </tr>
                                        <tr>
                                            <td>Sunday:</td>
                                            <td class="pull-right">09:00 AM To 8:00 PM</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.table-responsive -->
                        </div><!-- /.module-body -->
                    </div><!-- /.contact-timing -->
                    <!-- ============================================================= CONTACT TIMING : END ============================================================= -->
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-4">
                    <!-- ============================================================= INFORMATION============================================================= -->
                    <div class="contact-information">
                        <div class="module-heading">
                            <h4 class="module-title">Information</h4>
                        </div><!-- /.module-heading -->

                        <div class="module-body outer-top-xs">
                            <ul class="toggle-footer" style="">
                                <li class="Media">
                                    <div class="pull-left">
                                        <span class="icon fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <p>Kathmandu, Nepal.</p>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="pull-left">
                                        <span class="icon fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <p>(+977)9869216543<br>(+977) 9823181837</p>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="pull-left">
                                        <span class="icon fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <span><a href="https://www.pramesh.com/">www.pramu.com</a></span>
                                        <p>&copy Pramu</p>
                                    </div>
                                </li>

                            </ul>
                        </div><!-- /.module-body -->
                    </div><!-- /.contact-timing -->
                    <!-- ============================================================= INFORMATION : END ============================================================= -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.links-social -->

    <script src="js/auto-complete.js"></script>
    <link rel="stylesheet" href="css/auto-complete.css">
    <script>
        var demo1 = new autoComplete({
            selector: '#search111',
            minChars: 1,
            source: function (term, suggest) {
                term = term.toLowerCase();
                <?php
                $qry2 = mysqli_query($conn, "select * from product");
                ?>
                var string = "";
                <?php $string = "";
                while ($ss = mysqli_fetch_array($qry2)) {

                    $string .= "'" . strtoupper($ss['Name']) . "'" . ",";
                    //$string=implode(',',$string);
                

                }
                ?>
                //alert("<?php echo $string; ?>");
                var choices = [<?php echo $string; ?>];
                var suggestions = [];
                for (i = 0; i < choices.length; i++)
                    if (~choices[i].toLowerCase().indexOf(term)) suggestions.push(choices[i]);
                suggest(suggestions);
            }
        });
    </script>