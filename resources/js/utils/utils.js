// src/utils/utils.js

export function formatDate(dateString) {
    const date = new Date(dateString);
    const day = date.getDate();
    const month = date.toLocaleDateString('fr-FR', { month: 'long' });
  
    const daySuffix = day === 1 ? 'er' : '';
  
    return `${day}${daySuffix} ${month}`;
  }
  