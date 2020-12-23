package com.example.telekonsultasi.configfile;

public class ServerApi {
 //     public static final String IPServer="http://macarinaid.wsjti.com/RestApi/";
      public static final String IPServer="http://192.168.0.7/simrs/Web/api/";
//      public static final String IPServer="http://192.168.100.88/simrs/Web/api/";
    public static final String URL_REGIS=IPServer+"Registerakun";
    public static final String URL_LOGIN=IPServer+"Api_login";
    public static final String URL_USER=IPServer+"Profil?kd_regist=";
    public static final String URL_PUT_USER=IPServer+"Profil";
    public static final String URL_PUT_PASSWORD=IPServer+"Profil/password";
    public static final String URL_PERIKSA=IPServer+"Konsul/periksa";
    public static final String URL_GETPERIKSA=IPServer+"Konsul?kd_regist=";
    public static final String URL_GETPASIEN=IPServer+"Konsul/pasienselesai?kd_regist=";
    public static final String URL_BUKTI=IPServer+"Konsul/bukti";
    public static final String URL_UPLOAD_BUKTI=IPServer+"Konsul/bukti";
    public static final String URL_PASFOTO="http://192.168.100.88/simrs/Web/assets/images/user/";
    public static final String URL_GAMBARBRG="http://macarinaid.wsjti.com/uploads/barang/";
}
