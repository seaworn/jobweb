export function toKebabCase(string) {
  return string
    .match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
    .map(x => x.toLowerCase())
    .join('-');
}

export function getProperty(path, obj) {
  return path.split('.').reduce((accum, part) => accum && accum[part], obj || {});
}