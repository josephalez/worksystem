export default class DateHelper {

  constructor(fechota) {
    this.fechota = fechota;
  }

  static newDate() {
    const fechota = new Date();
    const myDateHelper = new DateHelper(fechota);
    return myDateHelper;
  }

  execute() {
    const fechota = this.fechota;

    this.dias = fechota.getDate();
    let dias = this.dias;

    if (dias < 10) dias = '0' + dias;
    let mes = fechota.getMonth() +1;
    this.mes = mes;
    if (mes < 10) mes = '0' + mes;


    let fecha = fechota.getFullYear() + "-" + mes + "-" + dias;

    this.fecha = fecha;

    var horas = fechota.getHours() +1;

    var minutos = fechota.getMinutes() +1;

    var segundos = fechota.getSeconds() +1;

    if (horas < 10) horas = '0' + horas;
    if (minutos < 10) minutos = '0'+ minutos;
    if (segundos < 10) segundos = '0'+ segundos;
    this.datetime = fecha + ' ' + horas + ':' + minutos + ':' + segundos;
    return this;
  }

  getDateTime() {
    return (this.execute()).datetime;
  }
  getDateComplete() {
    return (this.execute()).fecha;
  }
}
