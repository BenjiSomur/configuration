#include <iostream>
#include <bitset>
#include <vector>
#include <algorithm>
#include <random>
#include <string>
#include <cstdlib>

using namespace std;

pair<string, vector<int>> create_indiv(const int lnodes)
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

    constexpr int max_bits = (int)log2(lnodes) + 1;

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
