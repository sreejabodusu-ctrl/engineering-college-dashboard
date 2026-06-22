import streamlit as st
import pandas as pd
import plotly.express as px

# Page Configuration
st.set_page_config(
    page_title="Engineering College Dashboard",
    page_icon="🎓",
    layout="wide"
)

st.title("🎓 Engineering College Analytics Dashboard")

# Load Data
@st.cache_data
def load_data():
    return pd.read_csv("students.csv")

df = load_data()

# Sidebar Filters
st.sidebar.header("Filters")

branch_filter = st.sidebar.multiselect(
    "Select Branch",
    options=df["branch"].unique(),
    default=df["branch"].unique()
)

filtered_df = df[df["branch"].isin(branch_filter)]

# KPI Section
col1, col2, col3 = st.columns(3)

with col1:
    st.metric("Total Students", len(filtered_df))

with col2:
    st.metric("Total Branches", filtered_df["branch"].nunique())

with col3:
    st.metric("Average Year", round(filtered_df["year_of_study"].mean(), 1))

st.divider()

# Student Data
st.subheader("📋 Student Records")
st.dataframe(filtered_df, use_container_width=True)

st.divider()

# Branch Distribution
st.subheader("📊 Students by Branch")

branch_counts = (
    filtered_df["branch"]
    .value_counts()
    .reset_index()
)

branch_counts.columns = ["Branch", "Students"]

fig1 = px.bar(
    branch_counts,
    x="Branch",
    y="Students",
    title="Student Count by Branch"
)

st.plotly_chart(fig1, use_container_width=True)

# Gender Distribution
if "gender" in filtered_df.columns:

    st.subheader("👥 Gender Distribution")

    gender_counts = (
        filtered_df["gender"]
        .value_counts()
        .reset_index()
    )

    gender_counts.columns = ["Gender", "Count"]

    fig2 = px.pie(
        gender_counts,
        names="Gender",
        values="Count",
        hole=0.4
    )

    st.plotly_chart(fig2, use_container_width=True)

# Year Distribution
st.subheader("📈 Students by Year")

year_counts = (
    filtered_df["year_of_study"]
    .value_counts()
    .sort_index()
    .reset_index()
)

year_counts.columns = ["Year", "Students"]

fig3 = px.line(
    year_counts,
    x="Year",
    y="Students",
    markers=True,
    title="Year-wise Student Distribution"
)

st.plotly_chart(fig3, use_container_width=True)

# Search Student
st.subheader("🔍 Search Student")

search = st.text_input("Enter Student Name")

if search:
    result = filtered_df[
        filtered_df["student_name"]
        .str.contains(search, case=False, na=False)
    ]

    st.dataframe(result, use_container_width=True)

# Download CSV
st.subheader("⬇ Download Student Data")

csv = filtered_df.to_csv(index=False)

st.download_button(
    label="Download CSV",
    data=csv,
    file_name="students.csv",
    mime="text/csv"
)
