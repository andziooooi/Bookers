function AktualnościChange() {
      
    window.location.href = "index.php";
  }
  function PrzegladajChange() {
    window.location.href ="przegladaj.php";
  }
  function MojeWypChange() {
    window.location.href ="MojeWyp.php";
  }
  function KontaktChange() {
    window.location.href ="Kontakt.php";
  }
  function MojProfChange() {
    window.location.href = "MojProf.php";
  }
  function scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: 'instant'
    });
  }
  function LoginPage(){
    window.location.assign('./login.php');
  }
  function Logout() {
    window.location.href = "Logout.php";
  }
  function RegisterPage(){
    window.location.assign('./register.php');
}
function RegisterPageReturn(){
    window.location.assign('./MojProf.php');
}