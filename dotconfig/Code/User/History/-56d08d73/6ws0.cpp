#include <iostream>
#include <bitset>
#include <vector>
#include <algorithm>
#include <random>
#include <string>
#include <cstdlib>

using namespace std;

string dec2bin(int decimal)
{
    int binary = 0, remainder, product = 1;
    // Since the data type is int, it can only accept values up to 1023 before switching to long.s
    while (decimal != 0)
    {
        remainder = decimal % 2;
        binary = binary + (remainder * product);
        decimal = decimal / 2;
        product *= 10;
    }
    return to_string(binary);
}

pair<string, vector<int>> create_indiv(int lnodes)
{
    pair<string, vector<int>> indiv;

    vector<string> binaries;
    vector<int> reference(lnodes, 1);

    string binpart = "";
    vector<int> intpart;

    const int nodes = [&]()
    {
        int nodes = lnodes;
        return nodes;
    }();

    const int size_array = dec2bin(lnodes).size() + 1;
    constexpr int max_bits = (int)(size_array);

    for (int i = 1; i <= nodes; i++)
    {
        binaries.push_back(bitset<max_bits>(i).to_string());
    }
    for (auto l : binaries)
    {
        binpart += l;
    }

    return indiv;
}

int main()
{
    int nodes = 13;
    cout << nodes << endl;
    return 0;
}
