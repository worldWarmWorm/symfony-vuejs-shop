export function getProductInforvativeTitle(product) {
  return `#${product.id} ${product.title} / P: $${product.price} / Q: ${product.quantity}`;
}