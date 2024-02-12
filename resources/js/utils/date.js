import moment from 'moment';

export function formatDate(date) {
  return moment(date).format('HH:mm:ss DD-MM-YY');
}
