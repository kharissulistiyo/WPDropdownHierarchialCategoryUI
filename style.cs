/*---------------------------------------------------
    LESS Elements 0.9
  ---------------------------------------------------
    A set of useful LESS mixins
    More info at: http://lesselements.com
  ---------------------------------------------------*/
body {
  background: #ffffff;
  color: #7f8c8d;
  font-family: Optima, Segoe, "Segoe UI", Candara, Calibri, Arial, sans-serif;
  padding: 0;
  margin: 0;
}
p {
  margin-bottom: 30px;
}
.section {
  padding-bottom: 30px;
}
.page {
  width: 1200px;
  max-width: 100%;
  margin: 0 auto 0 auto;
}
.title {
  color: #536263;
}
.button {
  background: #de3681;
  color: #ffffff;
  text-decoration: none;
  -webkit-border-top-right-radius: 5;
  -webkit-border-bottom-right-radius: 5;
  -webkit-border-bottom-left-radius: 5;
  -webkit-border-top-left-radius: 5;
  -moz-border-radius-topright: 5;
  -moz-border-radius-bottomright: 5;
  -moz-border-radius-bottomleft: 5;
  -moz-border-radius-topleft: 5;
  border-top-right-radius: 5;
  border-bottom-right-radius: 5;
  border-bottom-left-radius: 5;
  border-top-left-radius: 5;
  -moz-background-clip: padding-box;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  padding: 8px 23px;
}
#head {
  text-align: center;
}
#head h1:after {
  content: '';
  display: block;
  width: 60px;
  border-bottom: 1px solid #e5e5e5;
  margin: 40px auto 40px auto;
}
#head .description {
  margin-bottom: 50px;
  font-size: 22.400000000000002px;
}
#head .button {
  display: inline-block;
  width: 120px;
  text-align: center;
}
.fork-menu {
  position: absolute;
  right: 0;
  top: 0;
  width: 150px;
  height: 150px;
  overflow: hidden;
}
.fork-menu .github-fork-ribbon {
  top: 42px;
  right: -43px;
  /* Rotate the banner 45 degrees */
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
}
.fork-menu a {
  /* Set the font */
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 13px;
  font-weight: 700;
  color: white;
  /* Set the text properties */
  text-decoration: none;
  text-shadow: 0 -1px rgba(0, 0, 0, 0.5);
  text-align: center;
  /* Set the geometry. If you fiddle with these you'll also need to tweak the top and right values in #github-fork-ribbon. */
  width: 200px;
  line-height: 20px;
  /* Set the layout properties */
  display: inline-block;
  padding: 2px 0;
  /* Add "stitching" effect */
  border-width: 1px 0;
  border-style: dotted;
  border-color: rgba(255, 255, 255, 0.7);
}
@media only screen and (max-width: 1199px) {
  .page {
    padding-left: 10px;
    padding-right: 10px;
    width: 80%;
  }
}
@media only screen and (min-width: 1199px) {
  #head .description {
    width: 450px;
    margin-left: auto;
    margin-right: auto;
  }
}
