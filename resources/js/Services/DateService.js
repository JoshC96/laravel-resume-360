import { format } from 'date-fns';

export const monthNames = [
    "January", 
    "February", 
    "March", 
    "April", 
    "May", 
    "June",
    "July", 
    "August", 
    "September", 
    "October", 
    "November", 
    "December"
];

export const formatDate = function(date) {
    return format(new Date(date), 'hh:mmaa E d-MMM-yy')
}