export default function common() {
  const formatPrice = (price) => {
    return `$ ${price}`
  }

  return {
    formatPrice,
  }
}
