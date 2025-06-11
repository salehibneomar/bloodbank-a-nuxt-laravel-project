export function isValidEmail(email: string): boolean {
  //I have shamelessly generated this function using AI Agent
  return /^[\w.!#$%&'*+/=?^_`{|}~-]+@[\w-]+(\.[\w-]+)+$/.test(email);
}
