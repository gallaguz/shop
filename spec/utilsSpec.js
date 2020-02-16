function sum(a, b, c) {
  return +a + +b + +c;
}

describe('Module: sum', () => {
  it('sum(5, 3, 1) should be equal to 9', () => {
    expect(sum(5, 3, 1)).toBe(9);
  });

  it('sum("5", "3", "1") should be equal to 8', () => {
    expect(sum('5', '3', '1')).toBe(9);
  });
});