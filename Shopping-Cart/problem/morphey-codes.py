import math

def morphey_code(n):
    result = []
    result = recursive(['1'], 1, n)
    result = result[:n]
    return result[::-1] #reverse

def recursive(nums,i, n):
    if i >= n:
        return nums

    nums = nums[: (i/2) + 1]

    bits = "01"
    newNums = []
    j = 0
    for num in nums:
        newNums.append(num + bits[j%2])
        j += 1
        newNums.append(num + bits[j%2])
    
    i+=1
    #print ' , '.join(newNums)
    return recursive(newNums, i, n)

if __name__ == "__main__":
    import sys
    result = morphey_code(int(sys.argv[1]))
    for value in result:
        print value